<?php

namespace App\Http\Controllers;

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
                'vaccineType' => 'required|string|max:255',
                'nextDueDate' => 'nullable|date',
                'doctor_id' => 'required', // Assuming Veterinarian model
                'status' => 'required',
            ]);

            // Check if the pet exists
            $pet = Pets::findOrFail($request->pet_id);

            // Create new vaccination record
            $vaccination = new Vaccination();
            $vaccination->pet_id = $pet->id;
            $vaccination->vaccine_type = $request->vaccineType;
            $vaccination->doctor_id = $request->doctor_id;
            $vaccination->next_vaccine_date = $request->nextDueDate ? $request->nextDueDate : null;
            $vaccination->status = $request->status;

            // Save the vaccination record to the database
            $vaccination->save();

            // Redirect with success message
            return redirect()->route('pets.show', ['pets' => $pet->id])
                ->with('success', 'Vaccination added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->with('error', 'Validation Error Please Check your Form Fields'); // Retain the old inputs for user convenience
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
