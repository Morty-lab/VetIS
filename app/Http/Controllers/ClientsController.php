<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Clients;
use App\Models\Pets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients  =  Clients::getAllClients();
        return view('owners.manage', ["clients" => $clients]);
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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'birthday' => 'required|date',
            'password' => ['required', 'min:8', 'confirmed'],
            'client_profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' =>$request->firstname." ".$request->lastname,
            'email' => $request->email,
            'role' => "client",
            'password' => Hash::make($request->password),
        ]);

        Clients::createClient(
            ['user_id' => $user->id,
            'client_name' => $request->firstname." ".$request->lastname,
            'client_address' => $request->address,
            'client_no' => $request->phone_number,
            'client_birthday' => $request->birthday,
            'client_profile_picture' => $request->file('client_profile_picture') ? $request->file(key: 'client_profile_picture')->store('profile_photos', 'public') : null,
            ]);


        return redirect()->route('owners.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Clients::getClientById($id);
        $pets = Clients::petsOwned($id);
        $billing = Billing::getAllBillsByClient($id);
//dd($clients);
        return view('owners.profile', ["client" => $client, "pets" => $pets, "billing" => $billing]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = ([
            'client_name' => $request->input('owner_name'),
            'client_address' => $request->input('owner_address'),
            'client_no' => $request->input('owner_no'),
            'client_birthday' => $request->input('owner_bday'),
        ]);
        Clients::updateClient($id, $data);

        $client = Clients::getClientById($id);

        User::where('id', $client->user_id)->update(['email'=>$request->input('owner_email')]);

        return redirect()->route('owners.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function disable($id){
        $client = Clients::where('id' ,$id)->first();

        $client->update(['status' => !$client->status]);

        return redirect()->route('owners.show',$id);
    }
    public function destroy(Clients $clients)
    {
        //
    }
}
