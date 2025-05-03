<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Notifications;
use App\Models\Products;
use App\Models\Stocks;
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
        $latestTransaction = TransactionModel::latest('id')->first();
        $nextReceiptNumber = $latestTransaction ? $latestTransaction->id + 1 : 1;

        // dd(json_encode($customers));

        return view('pos.pos', ["products" => $products, "customers" => $customers, 'nextReceiptNumber' => $nextReceiptNumber]);
    }

    public function receipt() {
        return view('pos.posReceipt');
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
//        dd($request->all());
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

            $productName = Products::find($product['productId'])->product_name;

            $productStock = Stocks::getAllStocksByProductId(
                $product['productId'],
            )->sum('stock');
            $subtracted = Stocks::getAllStocksByProductId(
                $product['productId'],
            )->sum('subtracted_stock');
            // dd($data);
            Stocks::subtractStock($product['productId'], $product['quantity']);
            TransactionDetailsModel::storeDetails($data);

            if ($productStock - $subtracted <= 20) {
                // Stocks::update($product['productId'], ['status' => 0]);
                Notifications::addNotif([
                    'visible_to' => 'staff',
                    'title' => 'Stocks Alert',
                    'message' => "{$productName} has less than 20 stocks left",
                ]);

            }


        }
        return redirect('/pos')->with('success', 'Transaction successful!.');
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
