<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointments::getAppointmentByClient(auth()->user()->id);

        return view('portal.main.dashboard',['appointments'=>$appointments]);

    }

    public function myPets(){
        $client = Clients::getClientByUserID(Auth::user()->id);
        $pets = Pets::getPetByClient($client->id);
        return view('portal.main.pets.petsList',['pets'=>$pets]);
    }

    public function addMyPet(Request $request){
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_breed' => 'required',
            'pet_gender' => 'required',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required',
            'pet_weight' => 'required|numeric',
        ]);

        $pet = new Pets($validatedData);
        $client = Clients::getClientByUserID(Auth::user()->id);
        $pet->owner_ID = $client->id;

        $pet->save();

        return redirect()->route('portal.mypets');
    }

    public function viewMyPet(Request $request){
        $id = request('petid');
        $pet = Pets::getPetByID($id);

        return view('portal.main.pets.view',['pet'=>$pet]);
    }

    public function editMyPet(Request $request){
        $id = request('petid');
        $pet = Pets::getPetByID($id);

        return view('portal.main.pets.edit',['pet'=>$pet]);

    }

    public function updateMyPet(Request $request){
        $id = request('petid');
        $pet = Pets::getPetByID($id);
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_breed' => 'required',
            'pet_gender' => 'required',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required',
            'pet_weight' => 'required',
        ]);


        $pet->update($validatedData);
        $pet->save();

        return redirect()->route('portal.mypets.view', ['petid'=>$pet->id]);
    }

    public function myAppointments(){
        $appointments = Appointments::getAppointmentByClient(auth()->user()->id);

        return view('portal.main.scheduling.view',['appointments'=>$appointments]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
