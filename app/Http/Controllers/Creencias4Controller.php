<?php

namespace App\Http\Controllers;

use App\Models\Creencias4;
use Illuminate\Http\Request;

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
       
       $fields = $request->validate(
           collect(range(1, 31))->mapWithKeys(fn ($i) => ["mcp4_$i" => 'required|numeric'])->toArray() + [
               'remaining_time' => 'required|integer|min:0',
               'applicant_id' => 'required|exists:applicants,id' 
           ]
       );

       $creencias4 = Creencias4::create($fields);
       return $creencias4;  
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
}
