<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Products;
use App\Models\TransactionDetailsModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::getAllProducts();
        $customers = Clients::getAllClients();

        // dd(json_encode($customers));

        return view('pos.pos', ["products" => $products, "customers" => $customers]);
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
            "client_id" => $request->customer_id,
            "sub_total" => $request->sub_total,
            "total_discount" => $request->discount,
        ];



        $transactionID =TransactionModel::storeTransaction($data);

        $productData = json_decode($request->products,true);


        foreach ($productData as $product) {
            $data = [
                "transaction_id" => $transactionID,
                "product_id" => $product['productId'],
                "quantity" => $product['quantity'],
                "price" => $product['currentPrice']
            ];
            TransactionDetailsModel::storeDetails($data);
        }



        return redirect('/pos');
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
