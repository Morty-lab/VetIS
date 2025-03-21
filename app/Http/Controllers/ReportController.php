<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Stocks;
use App\Models\Suppliers;
use App\Models\TransactionDetailsModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pos()
    {
        $dailySales = TransactionModel::getDailySalesReport();
        $monthlyReports = TransactionModel::getMonthlySalesReport();

//        dd($dailySales);

        return view('reports.posSalesReport.posSales',[ 'sales' => $dailySales,
            'monthlyReports' => $monthlyReports,]);
    }

    public function printDaily(Request $request){
        // Get today's date
        $date = request('date');

        // Fetch all transaction details from today
        $sales = TransactionDetailsModel::whereDate('created_at', $date)->get();

        // Fetch all products and suppliers for reference
        $products = Products::all();
        $suppliers = Suppliers::all();
        $stocks = Stocks::all();

        // Pass data to the view
        return view('reports.documents.posdaily', ['sales'=>$sales, 'products' =>$products, 'suppliers'=>$suppliers, 'stocks'=>$stocks,'date'=>$date]);
    }

    public function printMonthly(Request $request){
        $date = request('date');

        $sales = TransactionModel::getDailySalesReport();

        return view('reports.documents.posMonthly', ['sales'=>$sales, 'date'=>$date]);
    }


    public function inventory(){
        $products = Products::all();

        return view('reports.inventoryReport.inventoryReport', ['products' => $products]);
    }
    public function printProductList(){
        $products = Products::all();


        return view('reports.documents.productsList', ['products' => $products]);
    }

    public function printStockList(){
        $stocks = Stocks::getAllStocksByProductId(request('product_id'));

        return view('reports.documents.itemStock', ['stocks' => $stocks,'productId'=>request('product_id')]);
    }

    public function printStockListAll(){
        $stocks = Stocks::all();

        return view('reports.documents.allStock', ['stocks' => $stocks]);
    }

    public function printLowStock(){
        $products = Products::all();

        return view('reports.documents.lowStockList', ['products' => $products]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
