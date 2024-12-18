<?php

namespace App\Http\Controllers;

use App\Models\prueba;
use Illuminate\Http\Request;



class PruebaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Prueba::all();
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
        //
        $fields = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required'
        ]);

        $prueba = Prueba::create($fields);

        return $prueba;
    }

    /**
     * Display the specified resource.
     */
    public function show(prueba $prueba)
    {
        //
        return $prueba;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prueba $prueba)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, prueba $prueba)
    {
        //
        $fields = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required'
        ]);

        $prueba->update($fields);

        return $prueba;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prueba $prueba)
    {
        //
        $prueba->delete();

        return['mensaje' => 'The test was deleted'];
    }
}
