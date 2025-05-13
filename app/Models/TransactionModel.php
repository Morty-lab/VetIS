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
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(sub_total) as total_sales'),
            DB::raw('SUM(sub_total * (1 - total_discount / 100)) as revenue'),
            DB::raw('SUM((SELECT SUM(quantity) FROM transaction_details WHERE transaction_details.transaction_id = transactions.id)) as items_sold')
        )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'asc')
            ->get();
    }

    public static function getMonthlySalesReport()
    {
        return self::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(sub_total) as total_sales'),
            DB::raw('SUM(sub_total * (1 - total_discount / 100)) as revenue'),
            DB::raw('SUM((SELECT SUM(quantity) FROM transaction_details WHERE transaction_details.transaction_id = transactions.id)) as items_sold')
        )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'asc')
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
