<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Stocks;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::with(['stocks' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        $supplier = Suppliers::with('products.stocks')->get();

        return view('inventory.products', ["products" => $products, "suppliers" => $supplier]);
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
            'product_name' => $request->product_name,
            'price' => $request->price,
            'supplier_id' => $request->supplier,
            'product_category' => $request->category,
            'unit' => $request->unit
        ];
        Products::createProduct($data);
        return redirect()->route('products.index');
    }

    public function addStocks(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'stock' => $request->stock,
            'price' => 21,
            'status' => 1,
            'unit' => "test"
        ];
        Stocks::addStock($data);
        Products::updateProduct($id, ['status' => 1]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'supplier_id' => $request->supplier
        ];
        Products::updateProduct($id, $data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Products::deleteProduct($id);
        return redirect()->route('products.index');
    }
}
