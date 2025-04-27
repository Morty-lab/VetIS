<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::where('service_type', 'services')->get();

        return view('billing.services.list',['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function feesIndex()
    {
        $services = Services::where('service_type', 'fees')->get();

        return view('billing.fees.list',['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required',
            'service_price' => 'required',
            'service_type' => 'required',
        ]);

        Services::addService($validatedData);

        return redirect()->route('billing.services');


    }

    /**
     * Display the specified resource.
     */
    public function storeFees(Request $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required',
            'service_price' => 'required',
            'service_type' => 'required',
        ]);

        Services::addService($validatedData);

        return redirect()->route('billing.fees');
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
