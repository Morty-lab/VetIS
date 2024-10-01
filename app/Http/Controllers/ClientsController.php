<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Pets;
use Illuminate\Http\Request;

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

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Clients::getClientById($id);
        $pets = Clients::petsOwned($id);
//dd($clients);
        return view('owners.profile', ["client" => $client, "pets" => $pets]);
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
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
