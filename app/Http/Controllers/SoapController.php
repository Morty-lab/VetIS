<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\PetDiagnosis;
use App\Models\PetPlan;
use App\Models\PetRecords;
use App\Models\Pets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoapController extends Controller
{
    /**
     * Display Pet SOAP
     */
    public function index()
    {



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pet = Pets::find($id);
        $owner = Clients::find($pet->owner_ID);
        $vets = Doctor::all();



        return view('pets.forms.soap_add', ['pet' => $pet, 'vets' => $vets,'owner' => $owner]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $id)
    {

        $ownerID = Pets::find($id)->owner_ID;

        $rules = [
            'petID' => 'required|integer',
            'ownerID' => 'required|integer',
            'doctorID' => 'required|integer',
            'consultation_type' => 'required|string|max:255',
            'status' => 'required|integer',
            'complaint' => 'nullable|string|max:255',
            'date' => 'required|date'
        ];

        $data = [
            'petID' => $id,
            'ownerID' => $ownerID,
//            'doctorID' => (integer)$request->doctorID,
//            'consultation_type' => $consultation_types[$request->consultation_type],
//            'complaint' => $request->complaint,
            'record_date' => Carbon::now()->toDateTimeString(),
        ];



        PetRecords::createPetRecord($data);
        $recordID = PetRecords::latest('id')->first()->id;


        return redirect()->route('soap.view', ['id' => $id, 'recordID' => $recordID ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, int $recordID)
    {
        $pet = Pets::find($id);
        $owner = Clients::find($pet->owner_ID);
        $vets = Doctor::all();
        $record = PetRecords::getPetRecordById($recordID);
//        $petPlan = PetPlan::getAllByRecordID($id);
//        $examination = Examination::getExaminationByRecordID($recordID);
//        $diagnosis = PetDiagnosis::getDiagnosisByPet($recordID);

//        dd($diagnosis);
        return view('pets.forms.soap', ['pet' => $pet, 'vets' => $vets,'owner' => $owner ,'record' => $record ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function splitText($text){
        $lines = preg_split("/\r\n|\r|\n/",$text);
        $data = [];

        foreach ($lines as $line) {
            // Remove unnecessary whitespace
            $line = trim($line);
            if (!empty($line)) {
                // Check for key-value pairs separated by ":"
                if (strpos($line, ':') !== false) {
                    [$key, $value] = array_map('trim', explode(':', $line, 2));
                    // Normalize the key (convert to snake_case for database fields)
                    $normalizedKey = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $key));
                    $data[$normalizedKey] = $value;
                }
            }
        }

        return $data;
    }
    public function update(Request $request, int $id, int $recordID)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'consultation_type'  => 'nullable|integer', // Assuming it's stored as an integer
            'complaint'          => 'nullable|string',
            'examination'        => 'nullable|string',
            'diagnosis'          => 'nullable|string',
            'medication_given'   => 'nullable|string',
            'procedure_given'    => 'nullable|string',
            'remarks'            => 'nullable|string',
            'prescription'       => 'nullable|string',
        ]);

        try {
            // Fetch the record
            $record = PetRecords::findOrFail($recordID);

            // Update the record with validated data
            $record->update($validatedData);

            // Redirect back with success message
            return redirect()->route('soap.view', ['id' => $id, 'recordID' => $recordID])
                ->with('success', 'Record updated successfully.');
        } catch (\Exception $e) {
            // Handle errors (e.g., record not found, database issues)
            return redirect()->route('soap.view', ['id' => $id, 'recordID' => $recordID])
                ->with('error', 'Failed to update record: ' . $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
