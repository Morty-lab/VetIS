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
use App\Models\Stocks;
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
        $discounts = Services::where('service_type', 'discounts')->get();
        $fees = Services::where('service_type', 'fees')->get();
        $medication_id = Category::where('category_name', 'Medications')->first()->id;
        $vaccine_id = Category::where('category_name', 'Vaccines')->first()->id;
        $medications = Products::whereIn('product_category', [$medication_id, $vaccine_id])->get();


        return view('billing.add',['pets'=>$pet,'owner'=>$owner ,'services'=>$services, 'vet'=>$vet, 'medications'=>$medications, 'fees'=>$fees, 'discounts'=>$discounts]);
    }

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
{
    // Validate the incoming data (uncomment and adjust as needed)
    // $request->validate([
    //     'vet_id' => 'required',
    //     'user_id' => 'required',
    //     'payment_type' => 'required',
    //     'total_payable' => 'required',
    //     'total_paid' => 'required',
    // ]);

    $billing = Billing::create([
        'biller_id' => auth()->user()->id,
        'vet_id' => $request->vet_id,
        'user_id' => $request->user_id,
        'payment_type' => $request->payment_type,
        'total_payable' => $request->total_payable,
        'total_paid' => $request->cash_given,
        'discount' => $request->discount,
        'due_date' => $request->input('due_date', null),
    ]);

    // Register payment
    $payment = new Payments();
    $amountToPay = floatval($request->input('total_payable', 0));
        $discountDecimal = floatval($request->discount); // e.g. 0.2 for 20%

        if ($discountDecimal > 0) {
            $amountToPay = $amountToPay * (1 - $discountDecimal);
        }

        $payment->amount_to_pay = $amountToPay;

    $payment->amount_to_pay = $amountToPay;
    $payment->billing_id = $billing->id;
    $payment->cash_given = $request->input('cash_given');
    $payment->save();

    // Process bill services
    if ($request->has('bill') && is_array($request->bill)) {
        foreach ($request->bill as $service) {
            BillingServices::create([
                'pet_id' => $service['petID'],
                'billing_id' => $billing->id,
                'service_id' => $service['serviceID'],
                'service_price' => $service['price'],
                'quantity' =>  $service['quantity'] ?? 1
            ]);
        }
    }

    // Process fees
    if ($request->has('fees') && is_array($request->fees)) {
        foreach ($request->fees as $fee) {
            BillingServices::create([
                'pet_id' => $fee['petID'],
                'billing_id' => $billing->id,
                'service_id' => $fee['serviceID'],
                'service_price' => $fee['price'],
                'quantity' => 1
            ]);
        }
    }

    // Process medications and update stock
    if ($request->has('medications') && is_array($request->medications)) {
        foreach ($request->medications as $medication) {
            BillingServices::create([
                'pet_id' => $medication['petID'],
                'billing_id' => $billing->id,
                'product_id' => $medication['serviceID'],
                'service_price' => $medication['price'],
                'quantity' => $medication['quantity']
            ]);

            Stocks::subtractStock($medication['serviceID'], $medication['quantity']);
        }
    }

    Notifications::addNotif([
        'visible_to' => "staff",
        'link' => route('billing'),
        'notification_type' => 'success',
        'message' => "Bill for client " . Clients::where('id', $request->user_id)->first()->client_name . " has been created.",
    ]);

    return redirect()->route('billing')->with('success', 'Billing record and payment created successfully.');
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
        $payments = Payments::where('billing_id',$id)->orderByDesc('created_at')->get();

        return view('billing.view',['billing' => $bill,'owner'=>$owner,'pet'=>$pet,'services_availed'=>$services_availed,'services'=>$services, 'payments'=>$payments]);
    }

    public function print(Request $request){
        $id = $request->get('billingID');

        $bill = Billing::where('id',$id)->first();
        $owner = Clients::where('id',$bill->user_id)->first();
        // $pet = Pets::where('id',$bill->pet_id)->first();
        $services_availed = BillingServices::where('billing_id',$id)->get();
        $services = Services::getAllServices();
        $payments = Payments::where('billing_id',$id)->get();

        return view('billing.print',['billing' => $bill,'owner'=>$owner,'services_availed'=>$services_availed,'services'=>$services, 'payments'=>$payments]);
        
    }

    public function addPayment(Request $request)
    {
        $id = $request->get('billingID');
        $billing = Billing::findOrFail($id);

        // Calculate actual total payable with discount
        $totalPayable = $billing->total_payable - ($billing->total_payable * $billing->discount);

        // Current total paid
        $totalPaid = $billing->total_paid;

        // Remaining balance
        $remainingBalance = $totalPayable - $totalPaid;

        // Requested payment (cash given)
        $cashGiven = $request->input('cash_given');

        // Automatically lower the payment if it exceeds the remaining balance
        if ($cashGiven > $remainingBalance) {
            $cashGiven = $remainingBalance;
        }

        // Save payment with adjusted cashGiven
        $payment = new Payments();
        $payment->billing_id = $id;
        $payment->amount_to_pay = $request->input('amount_to_pay'); // You may want to adjust this too based on $cashGiven if needed
        $payment->cash_given = $cashGiven;
        $payment->save();

        // Update total paid
        $billing->total_paid += $cashGiven;

        // Ensure total_paid never exceeds total payable (extra safety)
        if ($billing->total_paid > $totalPayable) {
            $billing->total_paid = $totalPayable;
        }

        $billing->save();

        return redirect()->route('billing.view', ['billingID' => $id])
                        ->with('success', 'Payment record created successfully.');
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
