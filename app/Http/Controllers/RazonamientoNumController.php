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
            collect(range(1, 10))->mapWithKeys(fn ($i) => ["mrn_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'applicant_id' => 'required|exists:applicants,id',
                'current_step' => 'required|integer|min:1|max:17' // Ajusta el rango según el número de steps que tengas
            ]
        );
    
        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = RazonamientoNum::where('applicant_id', $fields['applicant_id'])->first();
    
        if ($existingRecord) {
            // Si existe un registro, actualizarlo
            $existingRecord->update($fields);
            $statusCode = 200;
        } else {
            // Crear un nuevo registro en la base de datos
            $razonamientoNum = RazonamientoNum::create($fields);
            $statusCode = 201;
        }
    
        // Actualizar el campo "status" en el registro del applicant
        Applicant::where('id', $fields['applicant_id'])->update(['status' => 6]);
    
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
    public function update(Request $request, RazonamientoNum $razonamientoNum)
    {
        $fields = $request->validate(
            collect(range(1, 10))->mapWithKeys(fn ($i) => ["mrn_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0'
            ]
        );
 
        $razonamientoNum->update($fields);
        return $razonamientoNum;
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
