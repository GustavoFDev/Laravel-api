<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class Creencias4 extends Model
{
    protected $fillable = [
        'applicant_id',
        'mcp4_1', //mcp4_1 -> modulo creencias personales 3 _ pregunta 1
        'mcp4_2',
        'mcp4_3',
        'mcp4_4',
        'mcp4_5',
        'mcp4_6',
        'mcp4_7',
        'mcp4_8',
        'mcp4_9',
        'mcp4_10',
        'mcp4_11',
        'mcp4_12',
        'mcp4_13',
        'mcp4_14',
        'mcp4_15',
        'mcp4_16',
        'mcp4_17',
        'mcp4_18',
        'mcp4_19',
        'mcp4_20',
        'mcp4_21',
        'mcp4_22',
        'mcp4_23',
        'mcp4_24',
        'mcp4_25',
        'mcp4_26',
        'mcp4_27',
        'mcp4_28',
        'mcp4_29',
        'mcp4_30',
        'mcp4_31',
        'remaining_time',
        'current_step'
    ];

    public function applicant() 
    { 
        return $this->belongsTo(Applicant::class, 'applicant_id'); 
    }
}
