<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('inventory.units', ["units" => $units]);
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
        $data = [
            "unit_name" => $request->unit_name
        ];

        Unit::createUnit($data);
        return redirect()->route('units.index');
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'unit_name' => 'required|string|max:255|unique:units,unit_name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validation failed. Please check the form and try again.');
        }

        $data = [
            "unit_name" => $request->unit_name
        ];

        Unit::updateUnit($data, $id);
        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $unit = Unit::findOrFail($id);

            // Check if the unit has connected products
            if ($unit->products()->exists()) {
                return redirect()->route('units.index')->with('error', 'This unit cannot be deleted as it is linked to one or more products.');
            }

            Unit::deleteUnit($id);
            return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('units.index')->with('error', 'Failed to delete unit.');
        }
    }
}
