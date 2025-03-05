<?php

namespace App\Http\Controllers;

use App\Models\Creencias1;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Creencias3;

class Creencias1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creencias1 = Creencias1::all();
        return $creencias1;
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
        $fields = $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'remaining_time' => 'required|integer|min:0',
            'current_step' => 'required|integer|min:1|max:17'
        ]);
    
        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = Creencias1::where('applicant_id', $fields['applicant_id'])->first();
    
        if ($existingRecord) {
            return response()->json(['message' => 'El registro ya existe'], 200);
        }
    
        // Crear un nuevo registro con valores por defecto
        $defaultValues = [];
        for ($i = 1; $i <= 48; $i++) {
            $defaultValues["mcp1_$i"] = 50;
        }
    
        $creencias1 = Creencias1::create(array_merge($fields, $defaultValues));
    
        return response()->json($creencias1, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Creencias1 $creencias1)
    {
        return $creencias1;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creencias1 $creencias1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'remaining_time' => 'required|integer|min:0',
            'current_step' => 'required|integer|min:1|max:17'
        ]);
    
        // Filtrar solo las preguntas enviadas
        $responses = collect($request->all())->filter(fn($value, $key) => str_starts_with($key, 'mcp1_'));
    
        // Buscar el registro basado en el applicant_id
        $creencias1 = Creencias1::where('applicant_id', $id)->first();
    
        if (!$creencias1) {
            return response()->json(['error' => 'Record not found'], 404);
        }
    
        // Actualizar el registro en Creencias1
        $creencias1->update($responses->toArray() + $fields);
    
        // Si current_step es 17, actualizar el status del applicant
        if ($fields['current_step'] == 17 || $fields['remaining_time'] == 0) {
            Applicant::where('id', $id)->update(['status' => 1]);
        }
    
        return response()->json($creencias1, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creencias1 $creencias1)
    {
        $creencias1->delete();

        return ['mensaje' => 'The data was deleted'];
    }

    public function getByApplicantId($applicantId)
    {
        $creencias1 = Creencias1::where('applicant_id', $applicantId)->get();
        return response()->json($creencias1);
    }
}
