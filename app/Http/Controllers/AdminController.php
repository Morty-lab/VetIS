<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Pets;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
        $admins = Admin::getAllAdmins();
        return view('user_management.admins.manage', ['admins' => $admins]);
    }

    public function show($id){
        $admin = Admin::getAdmin($id);
        return view('user_management.admins.profile', ['admin' => $admin]);
    }

    public function edit($id){
        $admin = Admin::getAdmin($id);
        return view('user_management.admins.options', ['admin' => $admin]);
    }

    public function store(Request $request){
        $userData = [
            "name" => $request->input('firstname')." ".$request->input('lastname'),
            "email" => $request->input('email'),
            "role" => "admin",
            "password" => $request->get('password'),
        ];

        $user = User::create($userData);

        $adminData = [
            "user_id" => $user->id,
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname'),
            "address" => $request->get('address'),
            "phone_number" => $request->get('phone_number'),
            "birthday" => $request->get('birthday'),
            "position" => $request->get('position'),
        ];

        Admin::addAdmin($adminData);

        return redirect()->route('admin.manage');
    }

    public function uploadPhoto(Request $request, $id)
    {
        // Validate the photo input
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png|max:5120', // Max size 5 MB
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        // Determine the role and find the corresponding profile model
        $role = $user->role;

        switch ($role) {
            case 'admin':
                $profile = Admin::where('user_id', $user->id)->first();
                break;

            case 'veterinarian':
                $profile = Doctor::where('user_id', $user->id)->first();
                break;

            case 'client':
                $profile = Clients::where('user_id', $user->id)->first();
                break;

            case 'staff':
            case 'cashier':
            case 'secretary':
                $profile = Staff::where('user_id', $user->id)->first();
                break;

            default:
                return response()->json(['success' => false, 'message' => 'Role not supported for profile photo update.'], 400);
        }

        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found for this user.'], 404);
        }

        // Store the photo in the storage
        $photoPath = $request->file('photo')->store('profile_photos', 'public');

        // Update the profile picture based on the model
        if($role == 'client'){
            $profile->update(['client_profile_picture' => $photoPath]);

        }else{
            $profile->update(['profile_picture' => $photoPath]);

        }

        return response()->json([
            'success' => true,
            'photo_url' => asset('storage/' . $photoPath),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'extensionname' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'birthday' => 'required|date',
        ]);

        $user = Auth::user();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                $profile = Admin::where('user_id', $user->id)->first();
                $profile->update([
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'extensionname' => $request->extensionname,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'birthday' => $request->birthday,
                ]);
                break;

            case 'staff':
            case 'cashier':
            case 'secretary':
                $profile = Staff::where('user_id', $user->id)->first();
                $profile->update([
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'extensionname' => $request->extensionname,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'birthday' => $request->birthday,
                ]);
                break;

            case 'veterinarian':
                $profile = Doctor::where('user_id', $user->id)->first();
                $profile->update([
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'extensionname' => $request->extensionname,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'birthday' => $request->birthday,
                ]);
                break;

            default:
                return response()->json(['success' => false, 'message' => 'Role not supported for profile update.'], 400);
        }

        $userModel = User::find($user->id);
        $userModel->update([
            'name' => $request->firstname . ' ' . (is_null($request->middlename) ? '' : $request->middlename . ' ') . $request->lastname . (is_null($request->extensionname) ? '' : ' ' . $request->extensionname),
        ]);


        return redirect()->back()->with('success', 'Your profile has been updated.');
    }




}
