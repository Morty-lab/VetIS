<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Pets;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::getAllDoctors();
        return view('doctors.manage', ['doctors' => $doctors]);
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
        // dd($request);
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone_number' => 'required',
            'birthday' => 'required|date',
            'position' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'profile_picture' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'role' => "veterinarian",
            'password' => Hash::make($request->password),
        ]);

        Doctor::createDoctor([
            'user_id' => $user->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'birthday' => $request->birthday,
            'position' => $request->position,
        ]);


        return redirect()->route('doctor.index')
            ->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function showProfile(string $id)
    {
        $doctor = Doctor::getDoctorById($id);
        $clients = Clients::getAllClients();
        $pets = Pets::getAllPets();



        // Pass the combined user and doctor information to the view
        return view('doctors.profile', ['doctor' => $doctor, 'clients' => $clients, 'pets' => $pets]);
    }

    public function show(string $id)
    {
        $doctor = Doctor::getDoctorById($id);
        return view('doctors.profile', ['doctor' => $doctor]);
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

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:20',
            'birthday' => 'required|date',
            'position' => 'required|max:255',
        ]);


        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id);

        // Update the doctor's information
        $doctor->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'birthday' => $validatedData['birthday'],
            'position' => $validatedData['position'],
        ]);

        // Find the associated user by user_id
        $user = User::findOrFail($doctor->user_id); // Use user_id field from Doctor model

        // Update the associated user information
        $user->update([
            'name' => $validatedData['firstname'] . ' ' . $validatedData['lastname'],
            'email' => $validatedData['email'],
        ]);

        // Redirect the user back to the doctor profile page with a success message
        return redirect()->route('doctor.profile', $id)->with('success', 'Doctor and user information updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
