<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stocks;
use App\Models\Notifications;
use App\Models\Unit;

class CheckLowStocks extends Command
{
    protected $signature = 'stocks:check-low';
    protected $description = 'Check for low stock levels and notify staff';

    public function handle()
    {
        $threshold = 5; // You can move this to a config file if needed

        // Get stocks where available stock is less than or equal to the threshold
        $products = \App\Models\Products::all();

        $lowStocks = collect();
        foreach ($products as $product) {
            $stock = Stocks::where('products_id', $product->id)->sum('stock');
            $subtracted = Stocks::where('products_id', $product->id)->sum('subtracted_stock');

            if (($stock - $subtracted) <= $threshold && ($stock - $subtracted) > 0) {
                $lowStocks->push((object) [
                    'products_name' => $product->product_name,
                    'remaining_stocks' => $stock - $subtracted,
                    'unit' => $product->unit
                ]);
            }
        }

        foreach ($lowStocks as $stock) {
            Notifications::addNotif([
                'visible_to' => "staff",
                'link' => route('products.index'), // Adjust route name accordingly
                'notification_type' => 'warning',
                'message' => "Stock for product $stock->products_name is running low. Only $stock->remaining_stocks ". Unit::where('id', $stock->unit)->first()->unit_name ." left.",
            ]);

            echo "Stock for product $stock->products_name is running low. Only $stock->remaining_stocks ". Unit::where('id', $stock->unit)->first()->unit_name ." left.\n";
        }

    }
}
