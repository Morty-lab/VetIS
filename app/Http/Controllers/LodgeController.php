<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\PetRecords;
use App\Models\Pets;
use Illuminate\Http\Request;

class LodgeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('lodge.index');
    }
    public function create()
    {
        return view('lodge.create');
    }
    public function view()
    {
        $petRecords = PetRecords::with(['pet', 'doctor', 'clients'])->orderBy('created_at', 'desc')->get();
        $pets = Pets::where('isArchived', 0)->get();
        $doctors = Doctor::all();
        $clients = Clients::all();

        return view('lodge.view', compact('pets', 'doctors', 'clients', 'petRecords'));
    }
    public function edit($id)
    {
        return view('lodge.edit', ['id' => $id]);
    }
    public function destroy($id)
    {
        return redirect()->route('lodge.index')->with('success', 'Lodge deleted successfully.');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return redirect()->route('lodge.index')->with('success', 'Lodge created successfully.');
    }
}
