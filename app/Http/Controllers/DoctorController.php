<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\PetRecords;
use App\Models\Pets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'middlename' => 'nullable|max:255',
            'lastname' => 'required|max:255',
            'extensionname' => 'nullable|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|confirmed',
            'address' => 'required|max:255',
            'phone_number' => 'required|regex:/^[0-9()\-\s]+$/|max:20',
            'birthday' => 'required|date|before_or_equal:today',
            'position' => 'required|max:255',
            'license_number' => 'nullable|numeric',
            'ptr_number' => 'nullable|numeric',
            'profile_picture' => 'nullable|image|mimes:jpg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->firstname . " " . $request->lastname,
            'email' => $request->email,
            'role' => "veterinarian",
            'password' => Hash::make($request->password),
        ]);

        Doctor::createDoctor([
            'user_id' => $user->id,
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'extensionname' => $request->input('extensionname'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'birthday' => $request->input('birthday'),
            'position' => $request->input('position'),
            'license_number' => $request->input('license_number'),
            'ptr_number' => $request->input('ptr_number'),
            'profile_picture' => $request->file('profile_picture')
                ? $request->file('profile_picture')->store('profile_pictures', 'public')
                : null,
        ]);

        return redirect()->route('doctor.index')
            ->with('success', 'Doctor created successfully.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showProfile(string $id)
    {
        $doctor = Doctor::where('id', $id)->first();
        $clients = Clients::getAllClients();
        $pets = Pets::getAllPets();
        $records = PetRecords::where('doctorID', $id)->get();


        // Pass the combined user and doctor information to the view
        return view('doctors.profile', ['doctor' => $doctor, 'clients' => $clients, 'pets' => $pets, 'records' => $records]);
    }

    public function show(string $id)
    {
        $doctor = Doctor::where('id', $id)->first();
        return view('doctors.profile', ['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname'       => 'required|max:255',
            'middlename'      => 'nullable|max:255',
            'lastname'        => 'required|max:255',
            'extensionname'   => 'nullable|max:255',
            'address'         => 'required|max:255',
            'phone_number'    => 'required|regex:/^[0-9()\-\s]+$/|max:20',
            'birthday'        => 'required|date|before_or_equal:today',
            'position'        => 'required|max:255',
            'license_number'  => 'nullable|numeric',
            'ptr_number'      => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with('from_doctors_update', true) // ✅ Add this
                ->with('error', 'Validation failed. Please check the form and try again.');
        }

        $validatedData = $validator->validated();

        try {
            // Update doctor
            $doctor = Doctor::findOrFail($id);
            $doctor->update([
                'firstname'      => $validatedData['firstname'],
                'middlename'     => $validatedData['middlename'] ?? null,
                'lastname'       => $validatedData['lastname'],
                'extensionname'  => $validatedData['extensionname'] ?? null,
                'address'        => $validatedData['address'],
                'phone_number'   => $validatedData['phone_number'],
                'birthday'       => $validatedData['birthday'],
                'position'       => $validatedData['position'],
                'license_number' => $validatedData['license_number'] ?? null,
                'ptr_number'     => $validatedData['ptr_number'] ?? null,
            ]);

            // Update associated user name only
            $user = User::findOrFail($doctor->user_id);
            $user->update([
                'name' => $validatedData['firstname'] . ' ' . $validatedData['lastname'],
            ]);

            return redirect()->route('doctor.profile', $id)
                ->with('from_doctors_update_success', true) // ✅ Add this
                ->with('success', 'Doctor and user information updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateEmail(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('updateEmailModal', true);  // Set flag to show modal
        }

        try {
            // Find the doctor and associated user
            $doctor = Doctor::findOrFail($id);
            $user = User::findOrFail($doctor->user_id);

            // Update the email address
            $user->update(['email' => $request->email]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Email updated successfully.')
                ->with('updateEmailModalSuccess', true);  // Set flag to show modal
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while updating the email.'])
                ->withInput()
                ->with('updateEmailModal', true);  // Set flag to show modal
        }
    }

    public function disableAccount(Request $request, $id)
    {

    }

    public function resetPassword(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('resetPasswordModal', true);
        }
        try {
            $user = \App\Models\User::findOrFail($doctor->user_id); // or Doctor::findOrFail if separate table
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return redirect()->back()
                ->with('success', 'Password has been reset successfully.')
                ->with('resetPasswordModalSuccess', true);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while resetting the password: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function disableVet($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->status = 0;
        $doctor->save();

        return redirect()->back()->with('success', 'Doctor account has been disabled.');
    }

    public function enableVet($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->status = 1;
        $doctor->save();

        return redirect()->back()->with('success', 'Doctor account has been enabled.');
    }


    public function uploadVetPhoto(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('uploadPhotoModal', true); // Show modal again if validation fails
        }
        try {
            $doctor = Doctor::findOrFail($id);

            if ($request->hasFile('profile_picture')) {
                $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $doctor->profile_picture = $filePath;
                $doctor->save();
            }

            return redirect()->back()
                ->with('uploadPhotoModalSuccess', true);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while uploading the photo.'])
                ->withInput()
                ->with('uploadPhotoModal', true);
        }
    }

}
