<?php

namespace App\Http\Controllers;

use App\Models\Creencias3;
use Illuminate\Http\Request;

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
        
        $fields = $request->validate(
            collect(range(1, 32))->mapWithKeys(fn ($i) => ["mcp3_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'applicant_id' => 'required|exists:applicants,id' 
            ]
        );

        $creencias3 = Creencias3::create($fields);
        return $creencias3;  
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
