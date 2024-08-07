<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Models\Clients;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pets::all();
        return view('pets.manage', ["pets" => $pets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Clients::all();
        return view('pets.add', ["clients" => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // In your PetController.php

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_breed' => 'required',
            'pet_gender' => 'required',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required',
            'pet_weight' => 'required|numeric',
            'pet_vaccinated' => 'nullable',
            'pet_neutered' => 'nullable',
            'pet_description' => 'nullable',
            'owner_name' => 'required|exists:clients,id',
        ]);

        $pet = new Pets($validatedData);
        $pet->owner_ID = $request->owner_name;
        $pet->vaccinated = $request->has('pet_vaccinated');
        $pet->neutered = $request->has('pet_neutered');
        $pet->save();

        return redirect()->route('pet.index')->with('success', 'Pet has been added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Pets $pets)
    {
        $pets->load('client');
        return view('pets.profile', ['pet' => $pets]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pets $pets)
    {
        $pets->load('client');
        return view('pets.edit', ['pet' => $pets]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pets $pets)
    {


        $request->validate([
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'pet_breed' => 'required|string|max:255',
            'pet_gender' => 'required|string|max:255',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required|string|max:255',
            'pet_weight' => 'required|numeric',
            'vaccinated' => 'nullable|boolean',
            'neutered' => 'nullable|boolean',
            'pet_description' => 'nullable|string',
            // Add any other fields you want to validate here
        ]);

        // dd($request, $pets);

        // Update the pet's information
        $pets->update([
            'pet_name' => $request->input('pet_name'),
            'pet_type' => $request->input('pet_type'),
            'pet_breed' => $request->input('pet_breed'),
            'pet_gender' => $request->input('pet_gender'),
            'pet_birthdate' => $request->input('pet_birthdate'),
            'pet_color' => $request->input('pet_color'),
            'pet_weight' => $request->input('pet_weight'),
            'vaccinated' => $request->input('vaccinated'),
            'neutered' => $request->input('neutered'),
            'pet_description' => $request->input('pet_description'),
            // Update any other fields here
        ]);

        // Redirect the user
        return redirect()->route('pets.show', $pets->id)
            ->with('success', 'Pet information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pets $pets)
    {
        //
    }
}
