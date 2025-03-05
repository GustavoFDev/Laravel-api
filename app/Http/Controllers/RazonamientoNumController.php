<?php

namespace App\Http\Controllers;

use App\Models\RazonamientoNum;
use Illuminate\Http\Request;
use App\Models\Applicant;

class RazonamientoNumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $razonamientoNum = RazonamientoNum::all();
        return $razonamientoNum;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos dinámicos, el tiempo restante, el applicant_id y el current_step
        $fields = $request->validate(
            collect(range(1, 10))->mapWithKeys(fn($i) => ["mrn_$i" => 'required|numeric'])->toArray() + [
                'applicant_id' => 'required|exists:applicants,id',
                'current_step' => 'required|integer|min:1|max:17',
                'remaining_time' => 'required|integer|min:0',
                'selected_options' => 'nullable|array',
                'selected_options.*' => 'integer|min:0|max:9' // Asegurar que cada elemento sea un número válido
            ]
        );

        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = RazonamientoNum::where('applicant_id', $fields['applicant_id'])->first();

        if ($existingRecord) {
            return response()->json(['message' => 'El registro ya existe'], 200);
        } else {
            // Crear un nuevo registro en la base de datos
            $fields['selected_options'] = $fields['selected_options'] ?? []; // Asegurar que sea un array
            $razonamientoNum = RazonamientoNum::create($fields);
            $statusCode = 201;
        }

        return response()->json($existingRecord ?? $razonamientoNum, $statusCode);
    }


    /**
     * Display the specified resource.
     */
    public function show(RazonamientoNum $razonamientoNum)
    {
        return $razonamientoNum;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RazonamientoNum $razonamientoNum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar solo los campos que llegan en la petición
        $validatedData = $request->validate([
            'remaining_time' => 'required|integer|min:0',
            'current_step' => 'required|integer|min:1|max:17',
            'selected_options' => 'nullable|array',
            'selected_options.*' => 'nullable|integer|min:0|max:9', // Permitir null o un número entre 0 y 5
        ] + collect(range(1, 10))->mapWithKeys(fn($i) => ["mrn_$i" => 'sometimes|required|numeric'])->toArray());

        // Buscar el registro del usuario
        $razonamientoNum = RazonamientoNum::where('applicant_id', $id)->first();

        if (!$razonamientoNum) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Filtrar solo los campos de mrl, current_step, remaining_time y selected_options
        $responses = collect($request->all())->filter(function ($value, $key) {
            return str_starts_with($key, 'mrn_') || in_array($key, ['current_step', 'remaining_time', 'selected_options']);
        });

        // Actualizar todos los valores recibidos sin afectar los demás
        $razonamientoNum->update($responses->toArray());

        // Si current_step es 16, actualizar el status del applicant
        if (($validatedData['current_step'] == 12 && $request->has('mrn_10')) || $validatedData['remaining_time'] == 0) {
            Applicant::where('id', $id)->update(['status' => 6]);
        }

        return response()->json([
            'message' => 'Record updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RazonamientoNum $razonamientoNum)
    {
        $razonamientoNum->delete();

       return ['mensaje' => 'The data was deleted'];
    }

    public function getByApplicantId($applicantId)
    {
        $razonamientoNum = RazonamientoNum::where('applicant_id', $applicantId)->get();
        return response()->json($razonamientoNum);
    }
}
