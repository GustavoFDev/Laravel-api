<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class Creencias3 extends Model
{
    protected $fillable = [
        'applicant_id',
        'mcp3_1', //mcp3_1 -> modulo creencias personales 3 _ pregunta 1
        'mcp3_2',
        'mcp3_3',
        'mcp3_4',
        'mcp3_5',
        'mcp3_6',
        'mcp3_7',
        'mcp3_8',
        'mcp3_9',
        'mcp3_10',
        'mcp3_11',
        'mcp3_12',
        'mcp3_13',
        'mcp3_14',
        'mcp3_15',
        'mcp3_16',
        'mcp3_17',
        'mcp3_18',
        'mcp3_19',
        'mcp3_20',
        'mcp3_21',
        'mcp3_22',
        'mcp3_23',
        'mcp3_24',
        'mcp3_25',
        'mcp3_26',
        'mcp3_27',
        'mcp3_28',
        'mcp3_29',
        'mcp3_30',
        'mcp3_31',
        'mcp3_32',
        'remaining_time',
        'current_step'
    ];

    public function applicant() 
    { 
        return $this->belongsTo(Applicant::class, 'applicant_id'); 
    }
}
