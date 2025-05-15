<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Daily Sales Report</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <style>
        body {
            margin: 30px;
        }

        /* Add margin for preview (on screen) */
        .document {
            border: 1px solid gray;
            padding: 30px;
        }

        /* Remove margin when printing */
        @media print {
            body {
                margin: 0;
            }

            .document {
                border: 0px solid gray;
                padding: 0;
            }

            .printable {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white">
    <div class="printable mt-3 mb-3">
        <div class="d-flex justify-content-between">
            <h1>PetHub</h1>
            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
        </div>
    </div>
    <div class="document bg-white">
        <div class="d-flex justify-content-between">
            <div class="text-start">
                <h1 class="mb-0">Pruderich Veterinary Clinic</h1>
                <p>Purok - 3, Dologon, Maramag, Bukidnon, Philippines</p>
            </div>
            <div class="text-end">
                @if (isset($date))
                    <h2 class="mb-0">POS Daily Sales Report</h2>
                    <p>{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</p>
                @elseif (isset($date_range))
                    <h2 class="mb-0">POS Sales Report for {{ \Carbon\Carbon::parse($date_range[0])->format('F j, Y') }} @if (array_key_exists(1, $date_range) ) to {{ \Carbon\Carbon::parse($date_range[1])->format('F j, Y') }} @endif</h2>
                @endif
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    {{--            <th>Supplier</th> --}}
                    {{--            <th>Supplier Price</th> --}}
                    <th>Retail Price</th>
                    <th>QTY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sales = $sales
                        ->groupBy('product_id')
                        ->map(function ($productSales) {
                            $totalQuantity = $productSales->sum('quantity');
                            $totalPrice = $productSales->sum(function ($sale) {
                                return $sale->quantity * $sale->price;
                            });
                            return [
                                'sku' =>
                                    App\Models\Products::where('id', $productSales->first()->product_id)
                                    ->first()->SKU,
                                'product_id' => $productSales->first()->product_id,
                                'quantity' => $totalQuantity,
                                'price' => $totalPrice / $totalQuantity,
                            ];
                        })
                        ->values();

                @endphp
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale['sku'] }}</td>
                        <td>{{ $products->where('id', $sale['product_id'])->first()->product_name }}</td>
                        <td>{{ number_format($sale['price'], 2) }}</td>
                        <td>{{ $sale['quantity'] }}</td>
                        <td>{{ number_format($sale['price'] * $sale['quantity'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-9 text-end">
                <h3 class="mb-0">Total Sales</h3>
                <h3 class="text-primary">₱
                    @if (isset($dateRangeSales))
                        {{ number_format($dateRangeSales->sum('sub_total') - $dateRangeSales->sum('discount'), 2) }}
                    @else
{{-- @foreach ($dailySales as $sale)
    <div class="text-end">
        <h5 class="mb-0">Subtotal for {{ \Carbon\Carbon::parse($sale->created_at)->format('F j, Y') }}</h5>
        <h5 class="text-primary">₱{{ number_format($sale->sub_total, 2) }}</h5>
    </div>
@endforeach --}}
                        @php

                    $dailySales = \App\Models\TransactionModel::whereDate('created_at', $date)->get();
                        @endphp
                        {{ number_format($dailySales->sum('sub_total'), 2) }}
                    @endif
                </h3>
            </div>
            {{-- <div class="col-md-3 text-end">
                <h3 class="mb-0">Revenue</h3>
                <h3 class="text-primary">₱ {{ number_format($dailySales->where('date', $date)->first()->revenue, 2) }}
                </h3> <!-- Revenue calculation -->
            </div> --}}
        </div>
    </div>
</body>

</html>
