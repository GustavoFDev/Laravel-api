<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class RazonamientoLog extends Model
{
    protected $fillable = [
        'applicant_id',
        'mrl_1', //mrnL_1 -> modulo razonamiento lógico _ pregunta 1
        'mrl_2',
        'mrl_3',
        'mrl_4',
        'mrl_5',
        'mrl_6',
        'mrl_7',
        'mrl_8',
        'mrl_9',
        'mrl_10',
        'mrl_11',
        'mrl_12',
        'mrl_13',
        'mrl_14',
        'mrl_15',
        'remaining_time',
        'current_step',
        'selected_options'
    ];

    public function applicant() 
    { 
        return $this->belongsTo(Applicant::class, 'applicant_id'); 
    }
}
