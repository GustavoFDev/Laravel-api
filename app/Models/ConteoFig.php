<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;
 
class ConteoFig extends Model
{
    protected $fillable = [
        'applicant_id',
        'mcf_1', //mcf_1 -> modulo Conteo de Figuras _ pregunta 1
        'mcf_2',
        'mcf_3',
        'mcf_4',
        'mcf_5',
        'mcf_6',
        'mcf_7',
        'mcf_8',
        'mcf_9',
        'mcf_10',
        'mcf_11',
        'mcf_12',
        'mcf_13',
        'mcf_14',
        'mcf_15',
        'mcf_16',
        'mcf_17',
        'mcf_18',
        'mcf_19',
        'mcf_20',
        'mcf_21',
        'mcf_22',
        'mcf_23',
        'mcf_24',
        'mcf_25',
        'mcf_26',
        'mcf_27'
    ];

    public function applicant() 
    { 
        return $this->belongsTo(Applicant::class, 'applicant_id'); 
    }
}
