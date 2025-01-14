<?php

namespace App\Http\Controllers;

use App\Models\CreenciasP;
use Illuminate\Http\Request;

class CreenciasPController extends Controller
{
    public function index()
    {
        $creenciasP = CreenciasP::all();
        return $creenciasP;
    }

    public function store(Request $request)
    {
        $fields = $request->validate([ 
            'mcp1_1' => 'required|numeric', //"mcp1_1 -> módulo creencias personales (número del módulo de creencias peronales) _ (número de respuesta) "
            'mcp1_2' => 'required|numeric',
            'mcp1_3' => 'required|numeric',
            'mcp1_4' => 'required|numeric',
            'mcp1_5' => 'required|numeric',
            'mcp1_6' => 'required|numeric',
            'mcp1_7' => 'required|numeric',
            'mcp1_8' => 'required|numeric',
            'mcp1_9' => 'required|numeric',
            'mcp1_10' => 'required|numeric',
            'mcp1_11' => 'required|numeric',
            'mcp1_12' => 'required|numeric',
            'mcp1_13' => 'required|numeric',
            'mcp1_14' => 'required|numeric',
            'mcp1_15' => 'required|numeric',
            'mcp1_16' => 'required|numeric',
            'mcp1_17' => 'required|numeric',
            'mcp1_18' => 'required|numeric',
            'mcp1_19' => 'required|numeric',
            'mcp1_20' => 'required|numeric',
            'mcp1_21' => 'required|numeric',
            'mcp1_22' => 'required|numeric',
            'mcp1_23' => 'required|numeric',
            'mcp1_24' => 'required|numeric',
            'mcp1_25' => 'required|numeric',
            'mcp1_26' => 'required|numeric',
            'mcp1_27' => 'required|numeric',
            'mcp1_28' => 'required|numeric',
            'mcp1_29' => 'required|numeric',
            'mcp1_30' => 'required|numeric',
            'mcp1_31' => 'required|numeric',
            'mcp1_32' => 'required|numeric',
            'mcp1_33' => 'required|numeric',
            'mcp1_34' => 'required|numeric',
            'mcp1_35' => 'required|numeric',
            'mcp1_36' => 'required|numeric',
            'mcp1_37' => 'required|numeric',
            'mcp1_38' => 'required|numeric',
            'mcp1_39' => 'required|numeric',
            'mcp1_40' => 'required|numeric',
            'mcp1_41' => 'required|numeric',
            'mcp1_42' => 'required|numeric',
            'mcp1_43' => 'required|numeric',
            'mcp1_44' => 'required|numeric',
            'mcp1_45' => 'required|numeric',
            'mcp1_46' => 'required|numeric',
            'mcp1_47' => 'required|numeric',
            'mcp1_48' => 'required|numeric',
        ]); 
                
        $creenciasP = CreenciasP::create($fields); 
        return $creenciasP;
       
    }

    public function show(CreenciasP $creenciasP)
    {
        return $creenciasP;
    }

    public function update(Request $request, CreenciasP $creenciasP)
    {
        $fields = $request->validate([
            'mcp1_1' => 'required|numeric', 
            'mcp1_2' => 'required|numeric',
            'mcp1_3' => 'required|numeric',
            'mcp1_4' => 'required|numeric',
            'mcp1_5' => 'required|numeric',
            'mcp1_6' => 'required|numeric',
            'mcp1_7' => 'required|numeric',
            'mcp1_8' => 'required|numeric',
            'mcp1_9' => 'required|numeric',
            'mcp1_10' => 'required|numeric',
            'mcp1_11' => 'required|numeric',
            'mcp1_12' => 'required|numeric',
            'mcp1_13' => 'required|numeric',
            'mcp1_14' => 'required|numeric',
            'mcp1_15' => 'required|numeric',
            'mcp1_16' => 'required|numeric',
            'mcp1_17' => 'required|numeric',
            'mcp1_18' => 'required|numeric',
            'mcp1_19' => 'required|numeric',
            'mcp1_20' => 'required|numeric',
            'mcp1_21' => 'required|numeric',
            'mcp1_22' => 'required|numeric',
            'mcp1_23' => 'required|numeric',
            'mcp1_24' => 'required|numeric',
            'mcp1_25' => 'required|numeric',
            'mcp1_26' => 'required|numeric',
            'mcp1_27' => 'required|numeric',
            'mcp1_28' => 'required|numeric',
            'mcp1_29' => 'required|numeric',
            'mcp1_30' => 'required|numeric',
            'mcp1_31' => 'required|numeric',
            'mcp1_32' => 'required|numeric',
            'mcp1_33' => 'required|numeric',
            'mcp1_34' => 'required|numeric',
            'mcp1_35' => 'required|numeric',
            'mcp1_36' => 'required|numeric',
            'mcp1_37' => 'required|numeric',
            'mcp1_38' => 'required|numeric',
            'mcp1_39' => 'required|numeric',
            'mcp1_40' => 'required|numeric',
            'mcp1_41' => 'required|numeric',
            'mcp1_42' => 'required|numeric',
            'mcp1_43' => 'required|numeric',
            'mcp1_44' => 'required|numeric',
            'mcp1_45' => 'required|numeric',
            'mcp1_46' => 'required|numeric',
            'mcp1_47' => 'required|numeric',
            'mcp1_48' => 'required|numeric',
        ]); 
                
        $creenciasP->update($fields);
        return $creenciasP;
    }

    public function destroy(CreenciasP $creenciasP)
    {
        $creenciasP->delete();

        return['mensaje' => 'The applicant was deleted'];
    }
}
