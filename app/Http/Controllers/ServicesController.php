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
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0.01',
            'service_type' => 'required|string|max:255',
        ], [
            'service_name.required' => 'Please enter the name of the service.',
            'service_name.string' => 'The service name must be a valid text.',
            'service_name.max' => 'The service name must not exceed 255 characters.',

            'service_price.required' => 'Please enter the price of the service.',
            'service_price.numeric' => 'The service price must be a valid number.',
            'service_price.min' => 'The service price must be greater than 0.',

            'service_type.required' => 'Please specify the service type.',
            'service_type.string' => 'The service type must be a valid text.',
            'service_type.max' => 'The service type must not exceed 255 characters.',
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
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'new_price' => 'required|numeric|min:0.01',
        ], [
            'new_price.required' => 'Please enter the price of the service.',
            'new_price.numeric' => 'The service price must be a valid number.',
            'new_price.min' => 'The service price must be greater than 0.',
        ]);

        // Find the service by its ID
        $service = Services::find($id);

        // Check if the service exists
        if (!$service) {
            return redirect()->route('billing.services')->with('error', 'Service not found.');
        }

        // Update the price of the service
        $service->service_price = $validatedData['new_price'];
        $service->save();

        // Redirect back with a success message
        return redirect()->route('billing.services')->with('success', 'Service price updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Services::find($id);

        // Check if the service exists
        if (!$service) {
            return redirect()->route('billing.services')->with('error', 'Service not found.');
        }

        // Delete the service
        $service->delete();

        // Redirect to the services page with a success message
        return redirect()->route('billing.services')->with('success', 'Service deleted successfully.');
    }
}
