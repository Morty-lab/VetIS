<?php

namespace App\Http\Controllers;

use App\Models\PetPlan;
use Illuminate\Http\Request;

class PetPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $serviceObject = json_decode($request->input('service'), false);

        $data = [
            'pet_record_id' => (integer)$id,
            'service_name' => $serviceObject->service,
            'date_return' => $serviceObject->date_return,
            'status' => ($serviceObject->status == 'Ongoing') ? true : false,
        ];


        PetPlan::createPlan($data);

        return redirect()->route('soap.view',[(integer)$id]);

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
    public function update(Request $request, $recordID,int $id)
    {

        $data = [
            'date_return' => $request->input('date'),
            'reason_for_return' => $request->input('reason_for_return'),
            'status' => (integer)$request->input('status'),
            'service_name' => $request->input('service_name'),
        ];

       PetPlan::updatePlan($id,$data);

        return redirect()->route('soap.view',[$recordID,$id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,$recordID)
    {
        PetPlan::deletePlan($id);

        return redirect()->route('soap.view',[(integer)$id]);
    }
}
