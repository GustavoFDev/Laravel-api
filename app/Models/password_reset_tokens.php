<?php

namespace App\Models;

use MongoDb\Laravel\Eloquent\Model;

class password_reset_tokens extends Model
{
    //
    protected $connection = 'mongodb'; // Usar MongoDB
    protected $collection = 'password_reset_tokens'; // Nombre de la colección

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    public $timestamps = false; // Laravel no maneja automáticamente timestamps aquí
}

