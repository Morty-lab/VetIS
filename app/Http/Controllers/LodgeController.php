<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Doctor;
use App\Models\PetLodgeRooms;
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
        $rooms = PetLodgeRooms::all();
        return view('lodge.index', ['rooms' => $rooms]);
    }
    public function create()
    {

        return view('lodge.create');
    }
    public function view()
    {
        $room = PetLodgeRooms::where('id', request('id'))->first();
        $pets = Pets::where('isArchived', 0)->get();
        $clients = Clients::all();

        return view('lodge.view', compact('pets', 'clients', 'room'));
    }
    public function edit($id)
    {
        return view('lodge.edit', ['id' => $id]);
    }
    public function destroy()
    {
        $roomId = request('room_id');
        PetLodgeRooms::destroy($roomId);

        return redirect()->route('lodge.index')->with('success', 'Room deleted successfully.');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $number = $request->input('roomQuantity');
        PetLodgeRooms::createRooms($number);
        return redirect()->route('lodge.index')->with('success', 'Room/s created successfully.');
    }

    public function checkIn(Request $request)
    {
        // Validate the request data
        $request->validate([
            'petOwner' => 'required|exists:clients,id',
            'pet' => 'required|exists:pets,id',
        ]);

        // Add the pet to the room occupants
        $roomId = $request->input('room_id'); // assuming room_id is sent in the request
        $petId = $request->input('pet');
        $occupant = new \App\Models\RoomOccupant();
        $occupant->room_id = $roomId;
        $occupant->pet_id = $petId;
        $occupant->check_in = now();
        $occupant->save();

        // update the room status to occupied
        $room = PetLodgeRooms::find($roomId);
        $room->status = 1;
        $room->save();


        return redirect()->route('lodge.view', ['id' => $roomId])->with('success', 'Pet checked in successfully.');
    }


    public function checkOut(Request $request)
    {
        // Validate the request data
        $request->validate([
            'room_id' => 'required|exists:pet_lodge_rooms,id',
        ]);



        // update the room occupants
        $occupant = \App\Models\RoomOccupant::where('id', request('occupant_id'))->where('check_out', null)->first();
        $occupant->check_out = now();
        $occupant->save();

        // Add the pet to the room occupants
        $roomId = request('room_id'); // assuming room_id is sent in the request
        $room = PetLodgeRooms::find($roomId);
        $room->status = 0;
        $room->save();

        return redirect()->route('lodge.view', ['id' => $roomId])->with('success', 'Pet checked out successfully.');
    }


    public function maintenanceDone(Request $request)
    {
        // Validate the request data
        $request->validate([
            'room_id' => 'required|exists:pet_lodge_rooms,id',
        ]);

        // update the room status to available
        $room = PetLodgeRooms::find(request('room_id'));
        $room->status = 0;
        $room->save();

        return redirect()->route('lodge.view', ['id' => request('room_id')])->with('success', 'Room maintenance done successfully.');
    }

    public function setUnderMaintenance(Request $request)
    {
        // Validate the request data
        $request->validate([
            'room_id' => 'required|exists:pet_lodge_rooms,id',
        ]);

        // update the room status to under maintenance
        $room = PetLodgeRooms::find(request('room_id'));
        $room->status = 2;
        $room->save();

        return redirect()->route('lodge.view', ['id' => request('room_id')])->with('success', 'Room set under maintenance successfully.');
    }


}
