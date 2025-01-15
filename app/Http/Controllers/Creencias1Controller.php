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
        // Validar los campos dinámicos y el tiempo restante
        $fields = $request->validate(
            collect(range(1, 48))->mapWithKeys(fn ($i) => ["mcp1_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0'
            ]
        );

        // Crear el registro en la base de datos
        $creencias1 = Creencias1::create($fields);
        return $creencias1;  
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
    public function update(Request $request, Creencias1 $creencias1)
    {
        $fields = $request->validate(
            collect(range(1, 48))->mapWithKeys(fn ($i) => ["mcp1_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0'
            ]
        );

        $creencias1->update($fields);
        return $creencias1;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creencias1 $creencias1)
    {
        $creencias1->delete();

        return ['mensaje' => 'The data was deleted'];
    }
}
