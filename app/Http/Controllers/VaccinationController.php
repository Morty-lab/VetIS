<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\DosageModel;
use App\Models\PetRecords;
use App\Models\Pets;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            // Validate incoming data
            $validatedData = $request->validate([
                'vaccinationType' => 'required|string|max:255',
            ]);

            // Check if the pet exists
            $pet = Pets::findOrFail($request->pet);

            // Create new vaccination record
            $vaccination = new Vaccination();
            $vaccination->pet_id = $pet->id;
            $vaccination->vaccine_type = $request->vaccinationType;

            // Save the vaccination record to the database
            $vaccination->save();

            // Redirect with success message
            return redirect()->route('records.vaccination.view', ['vaccination_id' => $vaccination->id])
                ->with('success', 'Vaccination added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->with('error', 'Validation Error. Please check your form fields.');
        }
    }

    public function showVaccinationRecords()
    {
        $petRecords = Vaccination::all();
        $pets = Pets::where('isArchived', 0)->get();
        $doctors = Doctor::all();
        $clients = Clients::all();

        return view('records.vaccinationRecordsList', compact('pets', 'doctors', 'clients', 'petRecords'));
    }

    public function showVaccination()
    {
        $vaccinationRecord = Vaccination::where('id', request('vaccination_id'))->first();
        $pet = Pets::where('id', $vaccinationRecord->pet_id)->where('isArchived', 0)->first();
        $doctors = Doctor::all();
        $client = Clients::where('id', $pet->owner_ID)->first();
        $dosages = DosageModel::where('vaccination_id', request('vaccination_id'))->orderBy('created_at', 'desc')->get();

        return view('records.vaccinationRecord.vaccinationRecord', compact('pet', 'doctors', 'client','vaccinationRecord','dosages'));
    }


    public function addDosage(Request $request)
    {
        try {
            // Validate the input fields
            $validated = $request->validate([
                'administered_by' => 'required|integer|exists:doctors,id',
                'next_dose_date' => 'nullable|date',
                'final_dose' => 'nullable|boolean',
            ]);

            // Create new dosage record
            $dosage = new DosageModel();
            $dosage->date_administered = date('Y-m-d');
            $dosage->next_scheduled_dose = $request->next_dose_date;
            $dosage->status = $request->final_dose ?? false;
            $dosage->administered_by = $request->administered_by;
            $dosage->vaccination_id = request('vaccination_id');

            // Save the dosage record to the database
            $dosage->save();

            // Redirect with success message
            return redirect()->route('records.vaccination.view', ['vaccination_id' => request('vaccination_id')])
                ->with('success', 'Dosage added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->with('error', 'Validation Error. Please check your form fields.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'vaccineType' => 'required|string|max:255',
            'nextDueDate' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        $vacID = request('vacID');

        try {
            // Find the vaccination record
            $vaccination = Vaccination::where('id', $vacID)->first();

            // Update the vaccination record
            $vaccination->update([
                'vaccine_type' => $validated['vaccineType'],
                'next_vaccine_date' => $request->has('nextDueDate') ? $validated['nextDueDate'] : null,
                'status' => $validated['status'],
            ]);

            // Return a success response (JSON or redirect depending on use case)
            return redirect()->back()->with('success', 'Vaccination updated successfully!');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., record not found or validation error)
            return redirect()->back()->with('error', 'Failed to update vaccination. ' . $e->getMessage());
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
