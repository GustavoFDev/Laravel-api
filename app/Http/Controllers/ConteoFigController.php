<?php

namespace App\Http\Controllers;

use App\Models\ConteoFig;
use Illuminate\Http\Request;
use App\Models\Applicant;

class ConteoFigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conteoFig = Conteofig::all();
        return $conteoFig;
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
            collect(range(1, 27))->mapWithKeys(fn ($i) => ["mcf_$i" => 'required|numeric'])->toArray() + [
                'applicant_id' => 'required|exists:applicants,id'
            ]
        );
    
        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = Conteofig::where('applicant_id', $fields['applicant_id'])->first();
    
        if ($existingRecord) {
            // Si existe un registro, actualizarlo
            $existingRecord->update($fields);
            $statusCode = 200;
        } else {
            // Crear un nuevo registro en la base de datos
            $rl = Conteofig::create($fields);
            $statusCode = 201;
        }
    
        // Actualizar el campo "status" en el registro del applicant
        Applicant::where('id', $fields['applicant_id'])->update(['status' => 4]);
    
        return response()->json($existingRecord ?? $rl, $statusCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConteoFig $conteoFig)
    {
        return $conteoFig;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConteoFig $conteoFig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConteoFig $conteoFig, $id)
    {
        $fields = $request->validate(
            collect(range(1, 27))->mapWithKeys(fn ($i) => ["mcf_$i" => 'required|numeric'])->toArray()
        );

        $rl = Conteofig::where('applicant_id', $id)->first();
        
        if($rl){
            $rl->update($fields);
            return response()->json($rl, 200);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConteoFig $conteoFig)
    {
        $conteoFig->delete();

       return ['mensaje' => 'The data was deleted'];
    }
}
