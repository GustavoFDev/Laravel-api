<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class RazonamientoNum extends Model
{
    protected $fillable = [
        'razonamientonum_id',
        'mrn_1', //mrn_1 -> modulo razonamiento númerico _ pregunta 1
        'mrn_2',
        'mrn_3',
        'mrn_4',
        'mrn_5',
        'mrn_6',
        'mrn_7',
        'mrn_8',
        'mrn_9',
        'mrn_10',
        'remaining_time'
    ];
    public function razonamientonum() 
    { 
        return $this->belongsTo(RazonamientoNum::class, 'applicant_id'); 
    }
}
