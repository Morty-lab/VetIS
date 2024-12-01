<?php

namespace App\Http\Controllers;

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
        $sales = TransactionModel::all();
        $monthlyReports = [];

        // Loop through all sales and group them by month and year
        foreach ($sales as $sale) {
            // Format the month and year (e.g., December 2024)
            $monthYear = $sale->created_at->format('F Y');

            // If the month doesn't exist in the array, initialize it
            if (!isset($monthlyReports[$monthYear])) {
                $monthlyReports[$monthYear] = [
                    'itemsSold' => 0,
                    'totalSales' => 0,
                    'totalRevenue' => 0
                ];
            }

            // Get the number of items sold for this sale
            $itemsSold = TransactionModel::getItemCount($sale->id);

            // Add the items sold, total sales, and total revenue to the corresponding month
            $monthlyReports[$monthYear]['itemsSold'] += $itemsSold;
            $monthlyReports[$monthYear]['totalSales'] += $sale->sub_total;
            $monthlyReports[$monthYear]['totalRevenue'] += ($sale->sub_total - ($sale->sub_total * ($sale->total_discount / 100)));
        }

        return view('reports.posSalesReport.posSales',['sales'=>$sales, 'monthlyReports'=>$monthlyReports]);
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
