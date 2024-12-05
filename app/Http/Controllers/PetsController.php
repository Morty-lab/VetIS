<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Doctor;
use App\Models\PetRecords;
use App\Models\Pets;
use App\Models\Clients;
use App\Models\Vaccination;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
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
                'pet_vaccinated' => 'nullable',
                'pet_neutered' => 'nullable',
                'pet_description' => 'nullable|string',
                'owner_name' => 'required|exists:clients,id',
                'vaccinated_anti_rabies' => 'nullable',
                'anti_rabies_vaccination_date' => 'nullable|date',
                'history_of_aggression' => 'nullable|string',
                'food_allergies' => 'nullable|string',
                'pet_food' => 'nullable|string',
                'okay_to_give_treats' => 'nullable',
                'last_groom_date' => 'nullable|date',
                'okay_to_use_photos_online' => 'nullable',
                'pet_condition' => 'nullable|string',
            ]);

            $lastGroomDate = $validatedData['last_groom_date']
                ? Carbon::parse($validatedData['last_groom_date'])->startOfMonth()->toDateString()
                : null;

            $antiRabiesVaccinationDate = $validatedData['anti_rabies_vaccination_date']
                ? Carbon::parse($validatedData['anti_rabies_vaccination_date'])->startOfMonth()->toDateString()
                : null;

            // Create a new Pet record with the validated data
            $pet = new Pets([
                    'pet_name' => $validatedData['pet_name'],
                    'pet_type' => $validatedData['pet_type'],
                    'pet_breed' => $validatedData['pet_breed'] ?? null,
                    'pet_gender' => $validatedData['pet_gender'],
                    'pet_birthdate' => $validatedData['pet_birthdate'] ?? null,
                    'pet_color' => $validatedData['pet_color'] ?? null,
                    'pet_weight' => $validatedData['pet_weight'] ?? null,
                    'vaccinated' => $request->input('vaccinated'),
                    'neutered' => $request->input('neutered'),
                    'pet_description' => $validatedData['pet_description'] ?? null,
                    'vaccinated_anti_rabies' => $request->input('vaccinated_anti_rabies'),
                    'anti_rabies_vaccination_date' => $antiRabiesVaccinationDate,
                    'history_of_aggression' => $validatedData['history_of_aggression'] ?? null,
                    'food_allergies' => $validatedData['food_allergies'] ?? null,
                    'pet_food' => $validatedData['pet_food'] ?? null,
                    'okay_to_give_treats' => $request->input('okay_to_give_treats'),
                    'last_groom_date' => $lastGroomDate,
                    'okay_to_use_photos_online' => $request->input('okay_to_use_photos_online') ?? 0,
                    'pet_condition' => $validatedData['pet_condition'] ?? null,
                ]);

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
        // Define validation rules
        $validatedData = $request->validate([
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'pet_breed' => 'nullable|string|max:255',
            'pet_gender' => 'required', // Assuming only male and female genders are valid
            'pet_birthdate' => 'nullable|date|before:today',
            'pet_color' => 'nullable|string|max:255',
            'pet_weight' => 'nullable|numeric|min:0',
            'pet_description' => 'nullable|string',
            'vaccinated' => 'nullable',
            'neutered' => 'nullable',
            'vaccinated_anti_rabies' => 'nullable',
            'anti_rabies_vaccination_date' => 'nullable|date|before_or_equal:today',
            'history_of_aggression' => 'nullable|string',
            'food_allergies' => 'nullable|string',
            'pet_food' => 'nullable|string',
            'okay_to_give_treats' => 'nullable',
            'last_groom_date' => 'nullable|date|before_or_equal:today',
            'okay_to_use_photos_online' => 'nullable',
            'pet_condition' => 'nullable|string',
        ]);

        // Retrieve the pet by ID
        $pet = Pets::find($petID);

//        dd($validatedData);

        // Check if the pet exists
        if (!$pet) {
            return redirect()->route('pets.index')->with('error', 'Pet not found.');
        }
        $lastGroomDate = $validatedData['last_groom_date']
            ? Carbon::parse($validatedData['last_groom_date'])->startOfMonth()->toDateString()
            : null;

        $antiRabiesVaccinationDate = $validatedData['anti_rabies_vaccination_date']
            ? Carbon::parse($validatedData['anti_rabies_vaccination_date'])->startOfMonth()->toDateString()
            : null;


        // Update the pet's information
        $updatedPet = Pets::updatePet($petID, [
            'pet_name' => $validatedData['pet_name'],
            'pet_type' => $validatedData['pet_type'],
            'pet_breed' => $validatedData['pet_breed'] ?? null,
            'pet_gender' => $validatedData['pet_gender'],
            'pet_birthdate' => $validatedData['pet_birthdate'] ?? null,
            'pet_color' => $validatedData['pet_color'] ?? null,
            'pet_weight' => $validatedData['pet_weight'] ?? null,
            'vaccinated' => $request->input('vaccinated'),
            'neutered' => $request->input('neutered'),
            'pet_description' => $validatedData['pet_description'] ?? null,
            'vaccinated_anti_rabies' => $request->input('vaccinated_anti_rabies'),
            'anti_rabies_vaccination_date' => $antiRabiesVaccinationDate,
            'history_of_aggression' => $validatedData['history_of_aggression'] ?? null,
            'food_allergies' => $validatedData['food_allergies'] ?? null,
            'pet_food' => $validatedData['pet_food'] ?? null,
            'okay_to_give_treats' => $request->input('okay_to_give_treats'),
            'last_groom_date' => $lastGroomDate,
            'okay_to_use_photos_online' => $request->input('okay_to_use_photos_online') ?? 0,
            'pet_condition' => $validatedData['pet_condition'] ?? null,
        ]);

        // Redirect the user with a success message
        if ($updatedPet) {
            return redirect()->route('pets.show', $petID)->with('success', 'Pet has been updated successfully.');
        }

        return redirect()->route('pets.show', $petID)->with('error', 'Failed to update pet.');
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
