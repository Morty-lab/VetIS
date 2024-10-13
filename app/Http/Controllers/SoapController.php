<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Pets;
use Illuminate\Http\Request;

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



        return view('pets.forms.soap', ['pet' => $pet, 'vets' => $vets,'owner' => $owner]);
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
