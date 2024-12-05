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
use Illuminate\Support\Facades\Validator;

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
        $stocks = Stocks::all();
        return view('inventory.products', [
            "products" => $products,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
            'stocks' => $stocks
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

        // Validation rules
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect()
                ->route('products.index')
                ->withErrors($validator)
                ->with('error', 'Validation failed! Please check the inputs and try again.')
                ->withInput();
        }

        // Data to save
        $data = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'product_category' => $request->category,
            'unit' => $request->unit,
        ];

        // Create product
        $product = Products::createProduct($data);

        // Return success message
        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    public function addStocks(Request $request, $id)
    {
        $data = [
            'user_id' =>  Auth::user()->id,
            'products_id' => $id,
            'supplier_id' => $request->supplier,
            'stock' => $request->stock,
            'price' => $request->stockPrice ,
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
