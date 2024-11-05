<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Suppliers::getAllSuppliers();

        // dd($suppliers);


        return view('inventory.suppliers', ['suppliers' => $suppliers]);
    }

    public function add(Request $request)
    {
        $data = [

            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'supplier_contact_person' => $request->supplier_contact_person,
            'supplier_phone_number' => $request->supplier_phone_number,
            'supplier_email_address' => $request->supplier_email_address

        ];

        Suppliers::addSupplier($data);

        return redirect('/suppliers');
    }

    public function update(Request $request, $id)
    {

        $data = [
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'supplier_contact_person' => $request->supplier_contact_person,
            'supplier_phone_number' => $request->supplier_phone_number,
            'supplier_email_address' => $request->supplier_email_address
        ];

        Suppliers::updateSupplier($data, $id);
        return redirect('/suppliers');
    }

    public function delete($id)
    {
        $supplier = Suppliers::deleteSupplier($id);

        return redirect('/suppliers');
    }
}
