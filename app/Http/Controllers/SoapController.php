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

use function PHPUnit\Framework\isNull;

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

        return view('pets.forms.soap_add', ['pet' => $pet, 'vets' => $vets, 'owner' => $owner]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = request('pet_id');
        $ownerID = Pets::find($id)->owner_ID;

        $request->validate([
            'doctorID' => 'required',
            'subject' => 'required|string|max:255',
        ], [
            'subject.required' => 'Please provide the subject for the medical record.',
            'doctorID.required' => 'Please select an attending veterinarian',
        ]);

        $data = [
            'petID' => $id,
            'ownerID' => $ownerID,
            'doctorID' => $request->input('doctorID'),
            'subject' => $request->input('subject'),
            'record_date' => Carbon::now()->toDateTimeString(),
        ];



        PetRecords::createPetRecord($data);
        $recordID = PetRecords::latest('id')->first()->id;


        return redirect()->route('soap.view', ['id' => $id, 'recordID' => $recordID]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $record = PetRecords::where('id', request('recordID'))->first();
        $examination = Examination::where('pet_record_id',$record->id)->first();
        // dd($record);
        $pet = Pets::where('id', request('id'))->first(); //Pets::find(request('id'));
        $owner = Clients::find($pet->owner_ID);
        $vets = Doctor::all();

        return view('pets.forms.soap', ['pet' => $pet, 'vets' => $vets, 'owner' => $owner, 'record' => $record, 'examination'=> $examination]);
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

    public function splitText($text)
    {
        $lines = preg_split("/\r\n|\r|\n/", $text);
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
            'complaint' => 'nullable|string',
            'temperature' => 'nullable|string',
            'heart_rate' => 'nullable|string',
            'respiratory_rate' => 'nullable|string',
            'weight' => 'nullable|string',
            'length' => 'nullable|string',
            'examination' => 'nullable|string',
            'height' => 'nullable|string',
            'body_condition' => 'nullable|array',
            'general_appearance' => 'nullable|array',
            'skin_coat_condition' => 'nullable|array',
            'eyes_ears_nose_throat' => 'nullable|array',
            'mouth_teeth' => 'nullable|array',
            'lymph_nodes' => 'nullable|array',
            'cardiovascular_system' => 'nullable|array',
            'respiratory_system' => 'nullable|array',
            'digestive_system' => 'nullable|array',
            'musculoskeletal_system' => 'nullable|array',
            'neurological_system' => 'nullable|array',
            'diagnosis' => 'nullable|string',
            'medication_given' => 'nullable|string',
            'procedure_given' => 'nullable|string',
            'remarks' => 'nullable|string',
            'prescription' => 'nullable|string',
        ]);

        $examination_data = [
            'pet_record_id' => $recordID,
            'temperature' => $request->input('temperature'),
            'heart_rate' => $request->input('heart_rate'),
            'respiration_rate' => $request->input('respiratory_rate'),
            'weight' => $request->input('weight'),
            'length' => $request->input('length'),
            'examination' => $request->input('examination'),
            'height' => $request->input('height'),
            'body_condition' => json_encode($request->input('body_condition', [])),
            'general_appearance' => json_encode($request->input('general_appearance', [])),
            'skin_coat_condition' => json_encode($request->input('skin_coat_condition', [])),
            'eyes_ears_nose_throat' => json_encode($request->input('eyes_ears_nose_throat', [])),
            'mouth_teeth' => json_encode($request->input('mouth_teeth', [])),
            'lymph_nodes' => json_encode($request->input('lymph_nodes', [])),
            'cardiovascular_system' => json_encode($request->input('cardiovascular_system', [])),
            'respiratory_system' => json_encode($request->input('respiratory_system', [])),
            'digestive_system' => json_encode($request->input('digestive_system', [])),
            'musculoskeletal_system' => json_encode($request->input('musculoskeletal_system', [])),
            'neurological_system' => json_encode($request->input('neurological_system', [])),
        ];



        // dd(request()->all());

        try {
            // Fetch the record
            $record = PetRecords::findOrFail($recordID);
            $examination = Examination::where('pet_record_id', $recordID)->first();

            if (is_null($examination)) {
                $examination = Examination::create($examination_data);
            } else {
                $examination->update($examination_data);
            }

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
