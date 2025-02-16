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
            'b_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'street' => 'required|string', 
            'number' => 'required|string',
            'col' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255', 
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'day_phone' => 'required|string|max:20', 
            'night_phone' => 'required|string|max:20',  
            'email_a' => 'required|string|max:255',
            'rfc' => 'required|string|max:255',
            'employee' => 'required|boolean',
            'former_employee' => 'required|boolean',
        ]); 
        
        $applicant = Applicant::create([
            'name_a' => $fields['name_a'],
            'surname_p' => $fields['surname_p'],
            'surname_m' => $fields['surname_m'],
            'b_date' => $fields['b_date'],
            'gender' => $fields['gender'],
            'street' => $fields['street'],
            'number' => $fields['number'],
            'col' => $fields['col'],
            'city' => $fields['city'],
            'state' => $fields['state'],
            'country' => $fields['country'],
            'postal_code' => $fields['postal_code'],
            'day_phone' => $fields['day_phone'],
            'night_phone' => $fields['night_phone'],
            'email_a' => $fields['email_a'],
            'rfc' => $fields['rfc'],
            'employee' => $fields['employee'],
            'former_employee' => $fields['former_employee'],
            'status' => 0, // Asignar el valor por defecto 0 a status
        ]); 
    
        return response()->json(['message' => 'Applicant created successfully', 'applicant' => $applicant], 201);
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
            'former_employee' => 'required|boolean',
            'required|string|max:255'
        ]);

        $applicant->update($fields);

        return $applicant;
    }

    public function destroy(applicant $applicant)
    {
        $applicant->delete();

        return['mensaje' => 'The applicant was deleted'];
    }

    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);
        return response()->json($applicant);
    }

      // Nueva función para obtener un applicant por RFC
      public function getApplicantByRFC($rfc)
      {
          $applicant = Applicant::where('rfc', $rfc)->first();
          if ($applicant) {
              return response()->json($applicant);
          } else {
              return response()->json(['message' => 'Applicant not found'], 404);
          }
      }
}
