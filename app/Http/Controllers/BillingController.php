<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingServices;
use App\Models\Category;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Notifications;
use App\Models\Payments;
use App\Models\Pets;
use App\Models\Products;
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
        $vets = Doctor::getAllDoctors();
        return view('billing.billing',['billings' => $billings,'clients' => $clients,'pets' => $pets,'billingServices' => $billingServices, 'vets' => $vets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $owner = Clients::where('id', $request->pet_owner)->first();
        $vet = Doctor::where('id', $request->vet)->first();
        $pet = Pets::where('owner_id', $request->pet_owner)->get();
        $services = Services::where('service_type', 'services')->get();
        $fees = Services::where('service_type', 'fees')->get();
        $medication_id = Category::where('category_name', 'Medications')->first()->id;
        $medications = Products::where('product_category', $medication_id)->get();


        return view('billing.add',['pets'=>$pet,'owner'=>$owner ,'services'=>$services, 'vet'=>$vet, 'medications'=>$medications, 'fees'=>$fees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
    //    dd(request()->all());

        // $request->validate([
        //     'vet_id' => 'required',
        //     'user_id' => 'required',
        //     'payment_type' => 'required',
        //     'total_payable' => 'required',
        //     'total_paid' => 'required',
        // ]);

        // Create a new billing record and save it
        $billing = Billing::create([
            'biller_id' => auth()->user()->id,
            'vet_id' => $request->vet_id,
            'user_id' => $request->user_id,
            'payment_type' => $request->payment_type,
            'total_payable' => $request->total_payable,
            'total_paid' => $request->cash_given,
            'due_date' => $request->input('due_date', null),
        ]);

        // Check if services are provided
        if ($request->has('bill') && is_array($request->bill)) {
            foreach ($request->bill as $service) {
                BillingServices::create([
                    'pet_id' => $service['petID'],
                    'billing_id' => $billing->id, // Use the ID of the saved billing record
                    'service_id' => $service['serviceID'],
                    'service_price' => $service['price'],
                    'quantity' => 1                ]);
            }
        }

        // Check if fees are provided
        if ($request->has('fees') && is_array($request->fees)) {
            foreach ($request->fees as $fee) {
                BillingServices::create([
                    'pet_id' => $fee['petID'],
                    'billing_id' => $billing->id, // Use the ID of the saved billing record
                    'service_id' => $fee['serviceID'],
                    'service_price' => $fee['price'],
                    'quantity' => 1
                ]);
            }
        }

        // Check if medications are provided
        if ($request->has('medications') && is_array($request->medications)) {
            foreach ($request->medications as $medication) {
                BillingServices::create([
                    'pet_id' => $medication['petID'],
                    'billing_id' => $billing->id, // Use the ID of the saved billing record
                    'product_id' => $medication['serviceID'],
                    'service_price' => $medication['price'],
                    'quantity' => $medication['quantity'] 
                ]);
            }
        }

        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('billing'),
            'notification_type' => 'success',
            'message' => "Bill for client " . Clients::where('id', $request->user_id)->first()->client_name . " has been created.",
        ]);

        // Redirect to the billing page
        return redirect()->route('billing')->with('success', 'Billing record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->get('billingID');

        $bill = Billing::where('id',$id)->first();
        $owner = Clients::where('id',$bill->user_id)->first();
        $pet = Pets::where('id',$bill->pet_id)->first();
        $services_availed = BillingServices::where('billing_id',$id)->get();
        $services = Services::getAllServices();
        $payments = Payments::where('billing_id',$id)->get();

        return view('billing.view',['billing' => $bill,'owner'=>$owner,'pet'=>$pet,'services_availed'=>$services_availed,'services'=>$services, 'payments'=>$payments]);
    }

    public function print(Request $request){
        $id = $request->get('billingID');

        $bill = Billing::where('id',$id)->first();
        $owner = Clients::where('id',$bill->user_id)->first();
        $pet = Pets::where('id',$bill->pet_id)->first();
        $services_availed = BillingServices::where('billing_id',$id)->get();
        $services = Services::getAllServices();
        $payments = Payments::where('billing_id',$id)->get();

        return view('billing.print',['billing' => $bill,'owner'=>$owner,'pet'=>$pet,'services_availed'=>$services_availed,'services'=>$services, 'payments'=>$payments]);

    }

    public function addPayment(Request $request){
        $id = $request->get('billingID');

        $payment = new Payments();
        $payment->billing_id = $id;
        $payment->amount_to_pay = $request->input('amount_to_pay');
        $payment->cash_given = $request->input('cash_given');
        $payment->save();

        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('billing.view', ['billingID' => $id]),
            'notification_type' => 'success',
            'message' => "Pethub has received " . $request->input('cash_given') . "From client " . Clients::where('id', $request->user_id)->first()->client_name . " for bill " . Billing::where('id', $id)->first()->billing_number,
        ]);

        return redirect()->route('billing.view',['billingID' => $id])->with('success', 'Payment record created successfully.');
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
