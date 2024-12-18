<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class prueba extends Model
{
    //
    protected $fillable = [
        'titulo',
        'descripcion',
    ];

}
