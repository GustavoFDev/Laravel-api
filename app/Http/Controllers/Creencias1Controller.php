<?php

namespace App\Http\Controllers;

use App\Models\Creencias1;
use Illuminate\Http\Request;

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
        // Validar los campos dinámicos, el tiempo restante, el applicant_id y el current_step
        $fields = $request->validate(
            collect(range(1, 48))->mapWithKeys(fn($i) => ["mcp1_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'applicant_id' => 'required|exists:applicants,id',
                'current_step' => 'required|integer|min:1|max:17' // Ajusta el rango según el número de steps que tengas
            ]
        );

        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = Creencias1::where('applicant_id', $fields['applicant_id'])->first();

        if ($existingRecord) {
            // Si existe un registro, actualizarlo
            $existingRecord->update($fields);
            return response()->json($existingRecord, 200);
        } else {
            // Crear un nuevo registro en la base de datos
            $creencias1 = Creencias1::create($fields);
            return response()->json($creencias1, 201);
        }
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
        $fields = $request->validate(
            collect(range(1, 48))->mapWithKeys(fn($i) => ["mcp1_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'current_step' => 'required|integer|min:1|max:17'
            ]
        );

        $creencias1 = Creencias1::where('applicant_id', $id)->first();

        if ($creencias1) {
            $creencias1->update($fields);
            return response()->json($creencias1, 200);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
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
