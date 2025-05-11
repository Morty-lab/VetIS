<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\Medications;
use App\Models\PetDiagnosis;
use App\Models\PetPlan;
use App\Models\PetRecords;
use App\Models\Pets;
use App\Models\Prescriptions;
use App\Models\ProcedureRecords;
use App\Models\Products;
use App\Models\Services;
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
        $examination = Examination::where('pet_record_id', $record->id)->first();
        $medications = Products::where('product_category', Category::where('category_name', 'Medications')->first()->id)->get();
        $recordTreatment = Medications::where('recordID', request('recordID'))->get();
        // dd($medications);
        $pet = Pets::where('id', request('id'))->first(); //Pets::find(request('id'));
        $owner = Clients::find($pet->owner_ID);
        $vets = Doctor::all();
        $services = Services::where('service_type', 'services')->get();
        $procedures = ProcedureRecords::where('recordID', request('recordID'))->get();
        $prescriptions = Prescriptions::where('recordID', request('recordID'))->get();


        // dd($recordTreatment);
        return view('pets.forms.soap', ['pet' => $pet, 'vets' => $vets, 'owner' => $owner, 'record' => $record, 'examination' => $examination, 'medications' => $medications, 'recordTreatment' => $recordTreatment, 'services' => $services, 'procedures' => $procedures, 'prescriptions' => $prescriptions]);
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

    public function deleteTreatment(Request $request)
    {
        $id = request('id');
        Medications::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
    public function deleteProcedure(Request $request)
    {
        $id = request('id');
        ProcedureRecords::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function deletePrescription(Request $request)
    {
        $id = request('id');
        Prescriptions::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function update(Request $request, int $id, int $recordID)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255',
            'doctorID' => 'required|integer|exists:doctors,id',
            'status' => 'required|integer|in:0,1',
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
            'medications' => 'nullable|array',
            'procedures' => 'nullable|array',
            'remarks' => 'nullable|string',
            'prescriptions' => 'nullable|array',
            'treatment_notes' => 'nullable|string',
            'prescription_notes' => 'nullable|string',
        ]);

        // dd($validatedData);

        // dd($request->all());

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


            if (isset($validatedData['medications'])) {
                foreach ($validatedData['medications'] as $medication) {
                    if (in_array(null, $medication, true) || in_array('', $medication, true)) {
                        continue;
                    }
                    if (array_key_exists('medication_id', $medication)) {
                        // Update existing medication
                        Medications::updateOrCreate(
                            ['id' => $medication['medication_id']],
                            [
                                'recordID' => $recordID,
                                'productID' => $medication['meds'],
                                'dosage' => $medication['dosage'],
                                'frequency' => $medication['frequency'],
                                'medication_type' => $medication['medication_type'],
                            ]
                        );
                    } else {
                        // Create new medication
                        Medications::create([
                            'recordID' => $recordID,
                            'productID' => $medication['meds'],
                            'dosage' => $medication['dosage'],
                            'frequency' => $medication['frequency'],
                            'medication_type' => $medication['medication_type'],
                        ]);
                    }
                }
            }
            if (isset($validatedData['procedures'])) {
                foreach ($validatedData['procedures'] as $procedure) {
                    if (in_array(null, $procedure, true) || in_array('', $procedure, true)) {
                        continue;
                    }
                    if (array_key_exists('procedure_id', $procedure)) {
                        // Update existing procedure
                        ProcedureRecords::where('id', $procedure['procedure_id'])->update([
                            'recordID' => $recordID,
                            'serviceID' => $procedure['services'],
                            'outcome' => $procedure['outcome'],
                        ]);
                    } else {
                        // Create new procedure
                        ProcedureRecords::create([
                            'recordID' => $recordID,
                            'serviceID' => $procedure['services'],
                            'outcome' => $procedure['outcome'],
                        ]);
                    }
                }
            }
            if (isset($validatedData['prescriptions'])) {
                foreach ($validatedData['prescriptions'] as $prescription) {
                    if (in_array(null, $prescription, true) || in_array('', $prescription, true)) {
                        continue;
                    }

                    if (array_key_exists('prescription_id', $prescription)) {
                        // Update existing prescription
                        Prescriptions::where('id', $prescription['prescription_id'])->update([
                            'recordID' => $recordID,
                            'medication_id' => $prescription['meds'],
                            'dosage' => $prescription['dosage'],
                            'frequency' => $prescription['frequency'],
                            'duration' => $prescription['duration'],
                        ]);
                    } else {
                        // Create new prescription
                        Prescriptions::create([
                            'recordID' => $recordID,
                            'medication_id' => $prescription['meds'],
                            'dosage' => $prescription['dosage'],
                            'frequency' => $prescription['frequency'],
                            'duration' => $prescription['duration'],
                        ]);
                    }
                }
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




    public function archive(int $id)
    {
        $record = PetRecords::findOrFail($id);
        return view('pets.forms.soap-archive', compact('record'));
    }

    public function archiveRecord(int $id)
    {
        try {
            $record = PetRecords::where('id', $id);
            $record->update(['status' => 2]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    // public function unarchiveRecord(int $id)
    // {
    //     try {
    //         $record = PetRecords::findOrFail($id);
    //         $record->update(['archived' => false]);
    //         return redirect()->route('soap.view', ['id' => $record->pet_id, 'recordID' => $id])
    //             ->with('success', 'Record unarchived successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->route('soap.view', ['id' => $record->pet_id, 'recordID' => $id])
    //             ->with('error', 'Failed to unarchive record: ' . $e->getMessage());
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
