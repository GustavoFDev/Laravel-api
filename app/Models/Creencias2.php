<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class Creencias2 extends Model
{
    protected $fillable = [
        'applicant_id',
        'mcp2_1', //mcp2_1 -> modulo creencias personales 2 _ pregunta 1
        'mcp2_2',
        'mcp2_3',
        'mcp2_4',
        'mcp2_5',
        'mcp2_6',
        'mcp2_7',
        'mcp2_8',
        'mcp2_9',
        'mcp2_10',
        'mcp2_11',
        'mcp2_12',
        'mcp2_13',
        'mcp2_14',
        'mcp2_15',
        'mcp2_16',
        'mcp2_17',
        'mcp2_18',
        'mcp2_19',
        'mcp2_20',
        'mcp2_21',
        'mcp2_22',
        'mcp2_23',
        'mcp2_24',
        'mcp2_25',
        'mcp2_26',
        'mcp2_27',
        'mcp2_28',
        'mcp2_29',
        'mcp2_30',
        'mcp2_31',
        'mcp2_32',
        'mcp2_33',
        'remaining_time',
        'current_step'
    ];

    public function applicant() 
    { 
        return $this->belongsTo(Applicant::class, 'applicant_id'); 
    }
}
