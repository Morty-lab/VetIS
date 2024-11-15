<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\Stocks;
use App\Models\Suppliers;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::getAllProducts();
        $suppliers = Suppliers::getAllSuppliers();
        $units = Unit::getAllUnits();
        $categories = Category::getAllCategories();
        $users = User::all();

        return view('inventory.products', [
            "products" => $products,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
        ]);
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
            'product_category' => $request->category,
            'unit' => $request->unit
        ];
        Products::createProduct($data);
        return redirect()->route('products.index');
    }

    public function addStocks(Request $request, $id)
    {
        $data = [
            'user_id' =>  Auth::user()->id,
            'products_id' => $id,
            'supplier_id' => $request->supplier,
            'stock' => $request->stock,
            'price' => 21,
            'status' => 1,
            'unit' => $request->unit,
            'expiry_date' => $request->expiry_date

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
