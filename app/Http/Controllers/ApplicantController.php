<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{

    public function index()
    {
       $applicants = Applicant::all();
        return $applicants;
    }


    public function store(Request $request)
    {
        $fields = $request->validate([ 
            'name_a' => 'required|string|max:255', 
            'surname_p' => 'required|string|max:255',
            'surname_m' => 'required|string|max:255', 
            'email_a' => 'required|string|max:255',
            'street' => 'required|string', 
            'number' => 'required|string',
            'col' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255', 
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'day_phone' => 'required|string|max:20', 
            'night_phone' => 'required|string|max:20',
            'b_date' => 'required|date', 
            'employee' => 'required|boolean',
            'former_employee' => 'required|boolean' 
        ]); 
                
        $applicant = Applicant::create($fields); 
        return $applicant;
       
    }

    public function show(applicant $applicant)
    {
        return $applicant;
    }

    public function update(Request $request, applicant $applicant)
    {
        $fields = $request->validate([
            'name_a' => 'required|string|max:255', 
            'surname_p' => 'required|string|max:255',
            'surname_m' => 'required|string|max:255', 
            'email_a' => 'required|string|max:255',
            'street' => 'required|string', 
            'number' => 'required|string',
            'col' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255', 
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'day_phone' => 'required|string|max:20', 
            'night_phone' => 'required|string|max:20',
            'b_date' => 'required|date', 
            'employee' => 'required|boolean',
            'former_employee' => 'required|boolean'
        ]);

        $applicant->update($fields);

        return $applicant;
    }

    public function destroy(applicant $applicant)
    {
        $applicant->delete();

        return['mensaje' => 'The applicant was deleted'];
    }
}
