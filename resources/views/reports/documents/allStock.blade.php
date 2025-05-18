<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Stocks Report</title>
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
                <div class="mb-0 text-lg text-dark">Pruderich Veterinary Clinic</div>
                <p>Purok - 3, Dologon, Maramag, Bukidnon, Philippines</p>
            </div>
            <div class=" text-end">
                <h2 class="mb-0">All Stocks Report</h2>
                <p>As of {{\Carbon\Carbon::now()->format('F d , Y')}}</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Date Added</th>
                    <th>Barcode</th>
                    <th>Brand</th>
                    <th>Product Name</th>
                    <th>Expiry Date</th>
                    <th>Supplier</th>
                    <th>Supplier Price</th>
                    <th>Selling Price</th>
                    <th>Stocks</th>
                    <th>Stocks Available</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                @php
                $product = \App\Models\Products::where('id', $stock->products_id)->first();
                @endphp
                <tr>
                    <td>{{sprintf("STK-%05d", $stock->id)}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{\Carbon\Carbon::parse($stock->expiry_date)->format('M d, Y')}}</td>
                    <td>{{\App\Models\Suppliers::where('id', $stock->supplier_id)->first()->supplier_name}}</td>
                    <td>Php {{$stock->price}}</td>
                    <td>Php {{$product->price}}</td>
                    <td>{{$stock->stock - $stock->subtracted_stock . " " . \App\Models\Unit::where('id',$stock->unit)->first()->unit_name}}</td>
                    <td>@if ($stock->stock - $stock->subtracted_stock <= 0)
                            <div class="badge bg-danger-soft text-danger rounded-pill">No Stocks
    </div>
    @elseif (($stock->stock - $stock->subtracted_stock) <= ($stock->stock * 0.1))
        <div class="badge bg-warning-soft text-warning rounded-pill">Low Stock</div>
        @else
        <div class="badge bg-primary-soft text-primary rounded-pill">Available</div>
        @endif</td>
        </tr>
        @endforeach

        </tbody>
        </table>
        </div>
</body>

</html>