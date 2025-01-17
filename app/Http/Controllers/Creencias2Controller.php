<?php

namespace App\Http\Controllers;

use App\Models\Creencias2;
use Illuminate\Http\Request;

class Creencias2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creencias2 = Creencias2::all();
        return $creencias2;
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
            collect(range(1, 33))->mapWithKeys(fn ($i) => ["mcp2_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'applicant_id' => 'required|exists:applicants,id' 
            ]
        );

        $creencias2 = Creencias2::create($fields);
        return $creencias2;  
    }

    /**
     * Display the specified resource.
     */
    public function show(Creencias2 $creencias2)
    {
        return $creencias2;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creencias2 $creencias2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creencias2 $creencias2)
    {
        $fields = $request->validate(
            collect(range(1, 33))->mapWithKeys(fn ($i) => ["mcp2_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0'
            ]
        );

        $creencias2->update($fields);
        return $creencias2;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creencias2 $creencias2)
    {
        $creencias2->delete();

        return ['mensaje' => 'The data was deleted'];
    }
}