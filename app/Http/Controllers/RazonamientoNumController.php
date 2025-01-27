<?php

namespace App\Http\Controllers;

use App\Models\RazonamientoNum;
use Illuminate\Http\Request;

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
        $fields = $request->validate(
            collect(range(1, 10))->mapWithKeys(fn ($i) => ["mrn_$i" => 'required|numeric'])->toArray() + [
            ]
        );
 
        $razonamientoNum = RazonamientoNum::create($fields);
        return $razonamientoNum; 
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
}
