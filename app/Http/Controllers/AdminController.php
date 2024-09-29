<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

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


}
