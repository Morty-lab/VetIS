<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff =  Staff::getStaff();

        return view('user_management.staffs.manage', ["staff" => $staff]);
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
        $staffUserData = [
            'name' => $request->firstnae . " " . $request->lastname,
            'email' => $request->email,
            'role' => $request->position,
            'password' => $request->password,
        ];



        $staff = User::create(
            $staffUserData
        );

       $staffData = [
            'user_id' => $staff->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'position' => $request->position,
            'birthday' => $request->birthday,
        ];

        Staff::createStaff($staffData);

        return redirect()->route('staffs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $staff = Staff::getStaffById($id);

        return view('user_management.staffs.profile', ["staff" => $staff]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $staff = Staff::getStaffById($id);

        return view('user_management.staffs.options', ["staff" => $staff]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'editBirthday' => 'nullable|date|before_or_equal:' . now()->toDateString(),
            'address' => 'nullable|string|max:255',
            'staff_email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:15',
        ]);

        $id = request('staffID');

        try {
            // Fetch the staff record
            $staff = Staff::findOrFail($id);

            // Update the staff's details
            $staff->update([
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'birthday' => $validated['editBirthday'],
                'address' => $validated['address'],
                'phone_number' => $validated['phone_number'],
            ]);

            // Update the associated user's email
            $user = User::findOrFail($staff->user_id);
            $user->update([
                'email' => $validated['staff_email'],
            ]);

            // Return a success response
            return redirect()->back()->with('success', 'Staff account updated successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Failed to update staff account: ' . $e->getMessage());
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
