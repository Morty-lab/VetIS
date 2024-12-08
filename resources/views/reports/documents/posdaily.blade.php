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
            <h2 class="mb-0">POS Daily Sales Report</h2>
            <p>{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</p>
        </div>
    </div>
    <hr class="mb-3">
    <table class="table">
        <thead>
        <tr>
            <th>Transaction No.</th>
            <th>Product Name</th>
{{--            <th>Supplier</th>--}}
{{--            <th>Supplier Price</th>--}}
            <th>Retail Price</th>
            <th>QTY</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php
        $dailySales = \App\Models\TransactionModel::getDailySalesReport();

        @endphp
        @foreach($sales as $sale)
            @php
                $s = $stocks->where('products_id',$sale->product_id)->first;
                $total = $sale->quantity * $sale->price;
            @endphp
            <tr>
                <td>{{ sprintf("TRX-%05d", $sale->id)}}</td>
                <td>{{ $products->where('id',$sale->product_id)->first()->product_name }}</td>
                <td>{{  number_format($sale->price, 2) }}</td>
{{--                <td>asd</td>--}}
{{--                <td>asd</td>--}}
                <td>{{$sale->quantity}}</td>
                <td>{{number_format($total, 2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-9 text-end">
            <h3 class="mb-0">Total Sales</h3>
            <h3 class="text-primary">₱ {{ number_format($dailySales->where('date',$date)->first()->total_sales, 2) }}</h3>
        </div>
        <div class="col-md-3 text-end">
            <h3 class="mb-0">Revenue</h3>
            <h3 class="text-primary">₱ {{number_format($dailySales->where('date',$date)->first()->revenue, 2)}}</h3> <!-- Revenue calculation -->
        </div>
    </div>
</div>
</body>

</html>
