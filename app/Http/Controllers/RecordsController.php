<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\PetRecords;
use App\Models\Pets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordsController extends Controller
{
    public function index()
    {

    }
    public function showMedicalRecords()
    {
        $userRole = Auth::user()->role;

        if ($userRole == 'veterinarian') {
            $vetID = Doctor::where('user_id', Auth::user()->id)->first()->id;
            $petRecords = PetRecords::with(['pet', 'doctor', 'clients'])
                ->where('doctorID', $vetID)
                ->whereNotIn('status', [2])
                ->orderBy('created_at', 'desc')
                ->get();

        } else {
            $petRecords = PetRecords::with(['pet', 'doctor', 'clients'])->whereNotIn('status', [2])->orderBy('created_at', 'desc')->get();

        }

        $pets = Pets::where('isArchived', 0)->get();
        $doctors = Doctor::all();
        $clients = Clients::all();

        return view('records.medicalRecordsList', compact('pets', 'doctors', 'clients', 'petRecords'));
    }



    public function createMedicalRecord(Request $request)
    {
        $request->validate([
            'petOwner' => 'required|exists:clients,id',
            'pet' => 'required|exists:pets,id',
            'veterinarian' => 'required|exists:doctors,id',
            'subject' => 'required|string|max:255',
        ], [
            'petOwner.required' => 'Please select a pet owner.',
            'pet.required' => 'Please select a pet.',
            'subject.required' => 'Please provide the subject for the medical record.',
            'veterinarian.required' => 'Please select an attending veterinarian.',
        ]);

        PetRecords::create([
            'ownerID' => $request->input('petOwner'),
            'petID' => $request->input('pet'),
            'doctorID' => $request->input('veterinarian'),
            'subject' => $request->input('subject'),
            'record_date' => Carbon::now()->toDateTimeString(),
        ]);

        $recordID = PetRecords::latest('id')->first()->id;

        return redirect()->route('soap.view', ['id' => $request->input('pet'), 'recordID' => $recordID])->with('success', 'Medical record created successfully.');
    }

    public function showArchivedMedicalRecords(Request $request)
    {
        $petRecords = PetRecords::with(['pet', 'doctor', 'clients'])->where('status', 2)->orderBy('created_at', 'desc')->get();
        $pets = Pets::where('isArchived', 1)->get();
        $doctors = Doctor::all();
        $clients = Clients::all();

        return view('records.archive', compact('pets', 'doctors', 'clients', 'petRecords'));

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
