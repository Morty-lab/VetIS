<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingServices;
use App\Models\Clients;
use App\Models\Pets;
use App\Models\Services;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Clients::all();
        $pets = Pets::all();
        $billings = Billing::all();
        $billingServices = BillingServices::all();
        return view('billing.billing',['billings' => $billings,'clients' => $clients,'pets' => $pets,'billingServices' => $billingServices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pet = Pets::getAllPets();
        $owner = Clients::getAllClients();

        $services = Services::getAllServices();
        return view('billing.add',['pet'=>$pet,'owner'=>$owner ,'services'=>$services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'pet_id' => 'required',
            'user_id' => 'required',
            'payment_type' => 'required',
            'total_payable' => 'required',
            'total_paid' => 'required',
        ]);

        // Create a new billing record and save it
        $billing = new Billing();
        $billing->pet_id = $validatedData['pet_id'];
        $billing->user_id = $validatedData['user_id'];
        $billing->payment_type = $validatedData['payment_type'];
        $billing->total_payable = $validatedData['total_payable'];
        $billing->total_paid = $validatedData['total_paid'];
        $billing->save(); // This ensures the ID is generated and available

        // Check if services are provided
        if ($request->has('services') && is_array($request->services)) {
            foreach ($request->services as $service) {
                BillingServices::create([
                    'billing_id' => $billing->id, // Use the ID of the saved billing record
                    'service_id' => $service,
                ]);
            }
        }

        // Redirect to the billing page
        return redirect()->route('billing')->with('success', 'Billing record created successfully.');
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