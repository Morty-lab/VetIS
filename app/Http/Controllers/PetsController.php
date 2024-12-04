<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Doctor;
use App\Models\PetRecords;
use App\Models\Pets;
use App\Models\Clients;
use App\Models\Vaccination;
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
        if(request('clientID') != null){

            return view('pets.add', ["clients" => $clients,"clientID" => request('clientID')]);


        }else{
            return view('pets.add', ["clients" => $clients]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    // In your PetController.php

    public function store(Request $request)
    {


        try {
            // Validate the request data
            $validatedData = $request->validate([
                'pet_name' => 'required',
                'pet_type' => 'required',
                'pet_breed' => 'required',
                'pet_gender' => 'required',
                'pet_birthdate' => 'required|date',
                'pet_color' => 'required',
                'pet_weight' => 'required|numeric',
                'pet_vaccinated' => 'nullable|boolean',
                'pet_neutered' => 'nullable|boolean',
                'pet_description' => 'nullable|string',
                'owner_name' => 'required|exists:clients,id',
                'vaccinated_anti_rabies' => 'nullable|boolean',
                'anti_rabies_vaccination_date' => 'nullable|date',
                'history_of_aggression' => 'nullable|string',
                'food_allergies' => 'nullable|string',
                'pet_food' => 'nullable|string',
                'okay_to_give_treats' => 'nullable|boolean',
                'last_groom_date' => 'nullable|date',
                'okay_to_use_photos_online' => 'nullable|boolean',
                'pet_condition' => 'nullable|string',
            ]);

            // Create a new Pet record with the validated data
            $pet = new Pets($validatedData);

            // Set the owner ID from the request data
            $pet->owner_ID = $request->owner_name;

            // Handle boolean values for vaccinated and neutered fields
            $pet->vaccinated = $request->has('pet_vaccinated');
            $pet->neutered = $request->has('pet_neutered');

            // Save the new pet to the database
            $pet->save();

            // Redirect back with success message
            return redirect()->route('pet.index')->with('success', 'Pet has been added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with input data and error messages
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Validation failed. Please check the form for errors.');
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Pets $pets)
    {
        $vets = Doctor::all();
        $appointments = Appointments::all();
        $pet_records = Petrecords::findByPetId($pets->id);
        $pets->load('client');
        $vaccinations = Vaccination::getVaccinationByPet($pets->id);
        return view('pets.general', ['pet' => $pets, 'appointments' => $appointments, 'pet_records' => $pet_records, 'vets' => $vets, 'vaccinations' => $vaccinations]);
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
    public function update(Request $request, $petID)
    {
        // Retrieve the pet by ID
        $pet = Pets::find($petID);

        // Check if the pet exists
        if (!$pet) {
            return redirect()->route('pets.show', $pet->id)->with('error', 'Pet not found.');
        }

        // Update the pet's information
        $pet->update([
            'pet_name' => $request->input('pet_name'),
            'pet_type' => $request->input('pet_type'),
            'pet_breed' => $request->input('pet_breed'),
            'pet_gender' => $request->input('pet_gender'),
            'pet_birthdate' => $request->input('pet_birthdate'),
            'pet_color' => $request->input('pet_color'),
            'pet_weight' => $request->input('pet_weight'),
            'vaccinated' => $request->has('pet_vaccinated'), // Handle the boolean as a checkbox
            'neutered' => $request->has('pet_neutered'), // Handle the boolean as a checkbox
            'pet_description' => $request->input('pet_description'),
            'vaccinated_anti_rabies' => $request->has('vaccinated_anti_rabies'), // Handle anti-rabies vaccination status
            'anti_rabies_vaccination_date' => $request->input('anti_rabies_vaccination_date'),
            'history_of_aggression' => $request->input('history_of_aggression'),
            'food_allergies' => $request->input('food_allergies'),
            'pet_food' => $request->input('pet_food'),
            'okay_to_give_treats' => $request->has('okay_to_give_treats'), // Handle as a boolean checkbox
            'last_groom_date' => $request->input('last_groom_date'),
            'okay_to_use_photos_online' => $request->has('okay_to_use_photos_online'), // Handle as a boolean checkbox
            'pet_condition' => $request->input('pet_condition'),
        ]);

        // Redirect the user with a success message
        return redirect()->route('pets.show', $pet->id)
            ->with('success', 'Pet information updated successfully.');
    }


    public function uploadPhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png|max:5120', // Max size 5 MB
        ]);

        $pet = Pets::find($id);

        if (!$pet) {
            return response()->json(['success' => false, 'message' => 'Pet not found.'], 404);
        }

        // Store the photo in the storage
        $photoPath = $request->file('photo')->store('pet_photos', 'public');

        // Update the pet's photo path in the database
        $pet->update(['pet_picture' => $photoPath]);

        return response()->json([
            'success' => true,
            'photo_url' => asset('storage/' . $photoPath),
        ]);
    }


    public function verifyPet(){
        Pets::getPetById(request('pet_id'))->update(['status' => true]);

        return redirect()->route('pets.show', request('pet_id'))->with('success', 'Pet verified successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pets $pets)
    {
        //
    }
}
