<?php

namespace App\Http\Controllers;

use App\Models\RazonamientoLog;
use Illuminate\Http\Request;

class RazonamientoLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $razonamientoLog = RazonamientoLog::all();
        return $razonamientoLog;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate(
            collect(range(1, 15))->mapWithKeys(fn ($i) => ["mrl_$i" => 'required|numeric'])->toArray() + [
                'applicant_id' => 'required|exists:applicants,id',
                'current_step'=> 'required|integer|min:1|max:16',
                'remaining_time' => 'required|integer|min:0'
            ]
        );

        $existingRecord = RazonamientoLog::where('applicant_id', $fields['applicant_id'])->first();
 
        if ($existingRecord) {
            $existingRecord->update($fields);
            return response()->json($existingRecord, 200);
        } else {
            $rl = RazonamientoLog::create($fields);
            return response()->json( $rl, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RazonamientoLog $razonamientoLog)
    {
        return $razonamientoLog;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RazonamientoLog $razonamientoLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RazonamientoLog $razonamientoLog, $id)
    {
        $fields = $request->validate(
            collect(range(1, 15))->mapWithKeys(fn ($i) => ["mrl_$i" => 'required|numeric'])->toArray() + [
                'remaining_time' => 'required|integer|min:0',
                'current_step'=> 'required|integer|min:1|max:16',
            ]
        );

        $rl = RazonamientoLog::where('applicant_id', $id)->first();
        
        if($rl){
            $rl->update($fields);
            return response()->json($rl, 200);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RazonamientoLog $razonamientoLog)
    {
        $razonamientoLog->delete();

       return ['mensaje' => 'The data was deleted'];
    }

    public function getByApplicantId($applicantId){
        $razonamientoLog = RazonamientoLog::where('applicant_id', $applicantId)->get();
        return response()->json($razonamientoLog);
    }
}
