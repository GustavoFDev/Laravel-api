<?php

namespace App\Http\Controllers;

use App\Models\escenariosRealistas;
use Illuminate\Http\Request;
use App\Models\Applicant;

class EscenariosRealistasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $er = EscenariosRealistas::all();
        return $er;
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
            collect(range(1, 80))->mapWithKeys(fn($i) => ["er_$i" => 'required|numeric'])->toArray() + [
                'applicant_id' => 'required|exists:applicants,id',
                'current_step' => 'required|integer|min:1|max:17',
                'remaining_time' => 'required|integer|min:0'
            ]
        );

        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = EscenariosRealistas::where('applicant_id', $fields['applicant_id'])->first();

        if ($existingRecord) {
            return response()->json(['message' => 'El registro ya existe'], 200);
        } else {
            // Crear un nuevo registro en la base de datos
            $er = EscenariosRealistas::create($fields);
            $statusCode = 201;
        }

        return response()->json($existingRecord ?? $er, $statusCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(escenariosRealistas $escenariosRealistas)
    {
        //
        return $escenariosRealistas;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(escenariosRealistas $escenariosRealistas)
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
            'current_step' => 'required|integer|min:1|max:17'
        ] + collect(range(1, 80))->mapWithKeys(fn($i) => ["er_$i" => 'sometimes|required|numeric'])->toArray());

        // Buscar el registro del usuario
        $er = EscenariosRealistas::where('applicant_id', $id)->first();

        if (!$er) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Filtrar solo los campos de mrl, current_step, remaining_time y selected_options
        $responses = collect($request->all())->filter(function ($value, $key) {
            return str_starts_with($key, 'er_') || in_array($key, ['current_step', 'remaining_time']);
        });

        // Actualizar todos los valores recibidos sin afectar los demás
        $er->update($responses->toArray());

    // Si current_step es 12 y se cumple alguna de las condiciones adicionales, actualizar el status del applicant
    if (($validatedData['current_step'] == 12 && $request->has('er_80')) || $validatedData['remaining_time'] == 0) {
        Applicant::where('id', $id)->update(['status' => 2]);
    }

        return response()->json([
            'message' => 'Record updated successfully',
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(escenariosRealistas $escenariosRealistas)
    {
        //
        $escenariosRealistas ->delete();
        return ['mensaje' => 'The data was deleted'];
    }

    public function getByApplicantId($applicantId)
    {
        $escenariosRealistas = EscenariosRealistas::where('applicant_id', $applicantId)->get();
        return response()->json($escenariosRealistas);
    }
    
}
