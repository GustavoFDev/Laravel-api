<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Applicant extends Model
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name_a',
        'surname_p',
        'surname_m',
        'b_date',  
        'gender',
        'street', 
        'number', 
        'col', 
        'city', 
        'state', 
        'country', 
        'postal_code', 
        'day_phone', 
        'night_phone', 
        'email_a',
        'rfc',
        'employee', 
        'former_employee',
        'status',
    ];

}
