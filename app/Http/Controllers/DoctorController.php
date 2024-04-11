<?php

namespace App\Http\Controllers;

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
            'role' => "doctor",
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
        $user = User::with('doctor')->find($id);

        // If the user or doctor information is not found, handle it accordingly
        if (!$user || !$user->doctor) {
            // Handle the case where the user or doctor is not found
            // For example, return a 404 error or redirect the user
            abort(404, 'User or Doctor not found');
        }

        // Pass the combined user and doctor information to the view
        return view('doctors.profile', ['doctor' => $user]);
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
            'name' => 'required|max:255',
        ]);

        // Find the doctor by ID
        $doctor = User::with('doctor')->find($id);

        // Update the doctor's information
        $doctor->doctor->update($validatedData);
        $doctor->update($validatedData);

        // Redirect the user back to the doctor management page with a success message
        return redirect()->route('doctor.profile', $id)->with('success', 'Doctor information updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
