<?php

namespace App\Http\Controllers;

use App\Models\Creencias4;
use Illuminate\Http\Request;
use App\Models\Applicant;

class Creencias4Controller extends Controller
{/**
    * Display a listing of the resource.
    */
   public function index()
   {
       $creencias4 = Creencias4::all();
       return $creencias4;
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
            collect(range(1, 31))->mapWithKeys(fn($i) => ["mcp4_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'applicant_id' => 'required|exists:applicants,id',
                'current_step' => 'required|integer|min:1|max:17' // Ajusta el rango según el número de steps que tengas
            ]
        );

        // Verificar si ya existe un registro para el applicant_id
        $existingRecord = creencias4::where('applicant_id', $fields['applicant_id'])->first();

        if ($existingRecord) {
            // Si existe un registro, actualizarlo
            $existingRecord->update($fields);
            $statusCode = 200;
        } else {
            // Crear un nuevo registro en la base de datos
            $creencias4 = creencias4::create($fields);
            $statusCode = 201;
        }

        // Actualizar el campo "status" en el registro del applicant
        Applicant::where('id', $fields['applicant_id'])->update(['status' => 7]);

        return response()->json($existingRecord ?? $creencias4, $statusCode);
    }

   /**
    * Display the specified resource.
    */
   public function show(Creencias4 $creencias4)
   {
       return $creencias4;
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Creencias4 $creencias4)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Creencias4 $creencias4)
   {
       $fields = $request->validate(
           collect(range(1, 31))->mapWithKeys(fn ($i) => ["mcp4_$i" => 'required|numeric'])->toArray() + [
               'remaining_time' => 'required|integer|min:0'
           ]
       );

       $creencias4->update($fields);
       return $creencias4;
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Creencias4 $creencias4)
   {
       $creencias4->delete();

       return ['mensaje' => 'The data was deleted'];
   }

   public function getByApplicantId($applicantId)
    {
        $creencias4 = Creencias4::where('applicant_id', $applicantId)->get();
        return response()->json($creencias4);
    }
}
