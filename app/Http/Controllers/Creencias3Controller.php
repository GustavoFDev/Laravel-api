<?php

namespace App\Http\Controllers;

use App\Models\Creencias3;
use Illuminate\Http\Request;
use App\Models\Applicant;

class Creencias3Controller extends Controller
{/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creencias3 = Creencias3::all();
        return $creencias3;
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
            collect(range(1, 48))->mapWithKeys(fn($i) => ["mcp1_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'applicant_id' => 'required|exists:applicants,id',
                'current_step' => 'required|integer|min:1|max:17' // Ajusta el rango según el número de steps que tengas
            ]
        );

        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = creencias3::where('applicant_id', $fields['applicant_id'])->first();

        if ($existingRecord) {
            // Si existe un registro, actualizarlo
            $existingRecord->update($fields);
            $statusCode = 200;
        } else {
            // Crear un nuevo registro en la base de datos
            $creencias3 = creencias3::create($fields);
            $statusCode = 201;
        }

        // Actualizar el campo "status" en el registro del applicant
        Applicant::where('id', $fields['applicant_id'])->update(['status' => 5]);

        return response()->json($existingRecord ?? $creencias3, $statusCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(Creencias3 $creencias3)
    {
        return $creencias3;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creencias3 $creencias3)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creencias3 $creencias3)
    {
        $fields = $request->validate(
            collect(range(1, 32))->mapWithKeys(fn ($i) => ["mcp3_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0'
            ]
        );

        $creencias3->update($fields);
        return $creencias3;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creencias3 $creencias3)
    {
        $creencias3->delete();

        return ['mensaje' => 'The data was deleted'];
    }

    public function getByApplicantId($applicantId)
    {
        $creencias3 = Creencias3::where('applicant_id', $applicantId)->get();
        return response()->json($creencias3);
    }
    
}
