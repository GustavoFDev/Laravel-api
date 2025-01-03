<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'name_a',
        'surname_p',
        'surname_m', 
        'email_a', 
        'street', 
        'number', 
        'col', 
        'city', 
        'state', 
        'country', 
        'postal_code', 
        'day_phone', 
        'night_phone', 
        'b_date', 
        'employee', 
        'former_employee'
    ];
}
