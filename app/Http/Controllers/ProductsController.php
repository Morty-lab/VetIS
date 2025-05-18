<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notifications;
use App\Models\Products;
use App\Models\Stocks;
use App\Models\Suppliers;
use App\Models\Unit;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
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

    public function checkStocks()
    {
        $id = request()->query('product_id');
        $stocks = Stocks::getAllStocksByProductId($id);
        $stocksAvailable = $stocks->map(function ($stock) {
            return [
                'stock_id' => $stock->id,
                // 'expiry_date' => $stock->expiry_date ? $stock->expiry_date->format('Y-m-d') : null,
                'price' => $stock->price,
                'stock' => $stock->stock - $stock->subtracted_stock
            ];
        })->filter(function ($stock) {
            return $stock['stock'] != 0;
        });

        return response()->json($stocksAvailable);
    }

    public function viewModal($id)
    {
        $product = Products::findOrFail($id);
        $units = Unit::all();
        $categories = Category::all();
        $stockforproduct = Stocks::getAllStocksByProductId($id);

        return view('inventory.modals.partials.viewProduct', compact('product', 'units', 'categories', 'stockforproduct'));
    }


    public function loadEditProductModal($id)
    {
        $product = \App\Models\Products::findOrFail($id);
        $suppliers = Suppliers::getAllSuppliers();
        $units = Unit::getAllUnits();
        $categories = Category::getAllCategories();
        $users = User::all();
        $stocks = Stocks::all();
        return view('inventory.modals.partials.editProduct', [
            "product" => $product,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
            'stocks' => $stocks
        ])->render();
    }

    public function loadDeleteProductModal($id)
    {
        $product = \App\Models\Products::findOrFail($id);
        $suppliers = Suppliers::getAllSuppliers();
        $units = Unit::getAllUnits();
        $categories = Category::getAllCategories();
        $users = User::all();
        $stocks = Stocks::all();
        return view('inventory.modals.partials.deleteProduct', [
            "product" => $product,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
            'stocks' => $stocks
        ])->render();
    }


    // ProductController.php
    public function loadAddStockModal($id)
    {
        $product = Products::findOrFail($id);
        $suppliers = Suppliers::all(); // Or however you fetch them

        return view('inventory.modals.partials.addStock', compact('product', 'suppliers'))->render();
    }

       public function loadEditStockModal($id, $stockid)
    {
        $product = \App\Models\Products::findOrFail($id);
        $suppliers = Suppliers::getAllSuppliers();
        $units = Unit::getAllUnits();
        $categories = Category::getAllCategories();
        $users = User::all();
        $stocks = \App\Models\Stocks::findOrFail($stockid);
        return view('inventory.modals.partials.editStock', [
            "product" => $product,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
            'stocks' => $stocks
        ])->render();
    }

    public function updateStock(Request $request, $productId, $stockId)
    {
        $request->validate([
            'supplier' => 'required|exists:suppliers,id',
            'stockPrice' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
        ]);

        $stock = Stocks::findOrFail($stockId); // Make sure you're using the correct model
        $stock->supplier_id = $request->supplier;
        $stock->supplier_price = $request->stockPrice;
        $stock->price = $request->selling_price;
        $stock->stock = $request->stock;
        $stock->expiry_date = $request->expiry_date;
        $stock->save();

        return redirect()->back()->with('success', 'Stock updated successfully!');
    }


    public function loadDeleteStockModal($id, $stockid)
    {
        $product = \App\Models\Products::findOrFail($id);
        $suppliers = Suppliers::getAllSuppliers();
        $units = Unit::getAllUnits();
        $categories = Category::getAllCategories();
        $users = User::all();
        $stocks =  \App\Models\Stocks::findOrFail($stockid);
        return view('inventory.modals.partials.deleteStock', [
            "product" => $product,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
            'stocks' => $stocks
        ])->render();
    }

    public function deleteStock($id, $stockid)
    {
        $product = Products::findOrFail($id);
        $stock = Stocks::where('products_id', $product->id)->where('id', $stockid)->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }

     public function loadRepackStockModal($id, $stockid)
    {
        $product = \App\Models\Products::findOrFail($id);
        $suppliers = Suppliers::getAllSuppliers();
        $units = Unit::getAllUnits();
        $categories = Category::getAllCategories();
        $users = User::all();
        $stocks = \App\Models\Stocks::findOrFail($stockid);
        return view('inventory.modals.partials.repackStock', [
            "product" => $product,
            "suppliers" => $suppliers,
            "units" => $units,
            'categories' => $categories,
            'users' => $users,
            'stocks' => $stocks
        ])->render();
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
            'category' => 'required|string|max:255',
            'product_sku' => 'required|string|unique:products,SKU|max:255',
            'unit' => 'required|string|max:255',
            'brand' => 'string|max:255'
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
            'SKU' => $request->product_sku,
            'product_name' => $request->product_name,
            'product_category' => $request->category,
            'unit' => $request->unit,
            'brand' => $request->brand
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
            'user_id' => Auth::user()->id,
            'products_id' => $id,
            'supplier_id' => $request->supplier,
            'stock' => $request->stock,
            'price' => $request->sellingPrice,
            'supplier_price' => $request->stockPrice,
            'status' => 1,
            'unit' => $request->unit,
            'expiry_date' => $request->expiry_date

        ];
        Stocks::addStock($data);
        Products::updateProduct($id, ['status' => 1]);
        $productName = Products::getProductById($id)->product_name;
        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => 'products.index',
            'notification_type' => 'success',
            'message' => "$request->stock stocks added to $productName",
        ]);
        return redirect()->route('products.index')->with('success', 'Stock added successfully.');
    }


    public function repackStock(Request $request, $stockid)
    {
        try {
            $stock = Stocks::findOrFail($stockid);
            Stocks::repackStock($stockid, $request->quantity);

            // Proceed with repacking...
            $products = Products::find($request->product_id);
            $newProduct = Products::createProduct([
                'SKU' => $request->repacked_SKU,
                'brand' => $products->brand,
                'product_name' => $request->product_name,
                'product_category' => $products->product_category,
                'unit' => $request->unit,
            ]);

            Stocks::addStock([
                'user_id' => Auth::id(),
                'products_id' => $newProduct->id,
                'supplier_id' => $request->supplier,
                'stock' => $request->number_repacked_units,
                'price' => $request->stock_price,
                'supplier_price' => $request->supplier_price,
                'status' => 1,
                'unit' => $request->unit,
                'expiry_date' => $stock->expiry_date
            ]);

            return redirect()->route('products.index')->with('success', 'Stock repacked successfully.');
            } catch (\Exception $e) {
                return redirect()->route('products.index')->with('error', $e->getMessage());
            }
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
    public function update(Request $request)
    {
        $id = request('id');

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_sku' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|exists:category,id',
            'unit' => 'required|exists:units,id'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect()
                ->route('products.index')
                ->withErrors($validator)
                ->with('error', 'Validation failed! Please check the inputs and try again.')
                ->withInput();
        }

        $data = [
            'product_name' => $request->product_name,
            'SKU' => $request->product_sku,
            'brand' => $request->brand,
            'product_category' => $request->category,
            'unit' => $request->unit
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
