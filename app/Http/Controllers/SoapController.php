<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\PetPlan;
use App\Models\PetRecords;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoapController extends Controller
{
    /**
     * Display Pet SOAP
     */
    public function index()
    {



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( $id)
    {
        $pet = Pets::find($id);
        $owner = Clients::find($pet->owner_ID);
        $vets = Doctor::all();



        return view('pets.forms.soap_add', ['pet' => $pet, 'vets' => $vets,'owner' => $owner]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,int $id)
    {
        $ownerID = Pets::find($id)->owner_ID;
        $consultation_types = [
            "Walk-In" => 1,
            "Consultation" => 2,
            "Vaccination" => 3,
            "Surgery" => 4
        ];
        $status = ($request->status == 'Filed') ? 1 : 0;
        $rules = [
            'petID' => 'required|integer',
            'ownerID' => 'required|integer',
            'doctorID' => 'required|integer',
            'consultation_type' => 'required|string|max:255',
            'status' => 'required|integer',
            'complaint' => 'nullable|string|max:255',
            'date' => 'required|date'
        ];

        $data = [
            'petID' => $id,
            'ownerID' => $ownerID,
            'doctorID' => (integer)$request->doctorID,
            'consultation_type' => $consultation_types[$request->consultation_type],
            'status' => $status,
            'complaint' => $request->complaint,
            'record_date' => $request->date
        ];



        PetRecords::createPetRecord($data);

        return redirect()->route('soap.view', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pet = Pets::find($id);
        $owner = Clients::find($pet->owner_ID);
        $vets = Doctor::all();
        $record = PetRecords::getPetRecordById($id);
        $petPlan = PetPlan::getAllByRecordID($id);

        return view('pets.forms.soap', ['pet' => $pet, 'vets' => $vets,'owner' => $owner ,'record' => $record ,'petPlan' => $petPlan]);
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
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
