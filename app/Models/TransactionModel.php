<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'client_id',
        'sub_total',
        'total_discount',
    ];

    public static function storeTransaction($data)
    {
        $newRecord = self::create($data);
        return $newRecord->id;
    }

    public static function getItemCount($id)
    {
        $details = TransactionDetailsModel::where('transaction_id', $id)->get();
        $items = 0;
        foreach ($details as $detail) {
            $items += $detail->quantity;
        }
        return $items;
    }

    public static function getDailySalesReport()
    {

        return self::select(
            DB::raw('DATE(transactions.created_at) as date'),
            DB::raw('SUM(transaction_details.quantity * transaction_details.price) as total_sales'),
            DB::raw('SUM(transaction_details.quantity) as items_sold')
        )
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->groupBy(DB::raw('DATE(transactions.created_at)'))
            ->orderBy(DB::raw('DATE(transactions.created_at)'), 'asc')
            ->get();
    }

    public static function getMonthlySalesReport()
    {


        return self::select(
            DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m") as month'),
            DB::raw('SUM(transaction_details.quantity * transaction_details.price) as total_sales'),
            DB::raw('SUM(transaction_details.quantity) as items_sold')
        )
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->groupBy(DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m")'), 'asc')
            ->get();
    }
    public static function getMonthlyRevenueReport()
    {
        return DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('stocks', 'transaction_details.product_id', '=', 'stocks.products_id')
            ->select(
                DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m") as month'),
                DB::raw('SUM((stocks.price - stocks.supplier_price) * transaction_details.quantity) as revenue')
            )
            ->groupBy(DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m")'), 'asc')
            ->get();
    }



    public static function getTransactionsByDateRange($dateStart, $dateEnd = null)
    {
        $query = self::select('transactions.*')
            ->distinct()
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->whereBetween('transactions.created_at', [
                $dateStart,
                $dateEnd ? $dateEnd . ' 23:59:59' : $dateStart . ' 23:59:59'
            ])
            ->orderBy('transactions.created_at', 'asc');

        return $query->get();
    }

}
