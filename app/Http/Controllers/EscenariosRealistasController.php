<?php

namespace App\Http\Controllers;

use App\Models\escenariosRealistas;
use Illuminate\Http\Request;

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
                'remaining_time' => 'required|integer|min:0',
                'status' => 'required|integer|min:0'
            ]
        );

        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = EscenariosRealistas::where('applicant_id', $fields['applicant_id'])->first();

        if ($existingRecord) {
            // Si existe un registro, actualizarlo
            $existingRecord->update($fields);
            return response()->json($existingRecord, 200);
        } else {
            // Crear un nuevo registro en la base de datos
            $er = EscenariosRealistas::create($fields);
            return response()->json($er, 201);
        }
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
        //
        $fields = $request->validate(
            collect(range(1, 80))->mapWithKeys(fn($i) => ["er_$i" => 'required|numeric'])->toArray() + [
                'current_step' => 'required|integer|min:1|max:17',
                'remaining_time' => 'required|integer|min:0',
                'status' => 'required|integer|min:0'
            ]
        );

        $er = EscenariosRealistas::where('applicant_id', $id)->first();

        if ($er) {
            $er->update($fields);
            return response()->json($er, 200);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
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
}
