<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock List Report</title>
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
            <div class=" text-end">
                <h2 class="mb-0">Low Stock Report</h2>
                <p>As of {{\Carbon\Carbon::now()->format('F d , Y')}}</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Stocks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                @php
                $stocks = \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('stock');
                $subtracted = \App\Models\Stocks::getAllStocksByProductId($product->id)->sum('subtracted_stock');
                @endphp
                @if(($stocks - $subtracted) <= ($stocks * 0.1))
                    <tr>
                    <td>{{ $product->SKU }}</td>
                    <td>{{ $product->product_name }} </td>
                    <td>{{ ucfirst(\App\Models\Unit::where('id', $product->unit)->first()->unit_name) }}</td>
                    <td>{{ \App\Models\Category::where('id',$product->product_category)->first()->category_name }}</td>
                    <td> {{$stocks - $subtracted ?? 'No'}} Stock/s Available</td>
                    </tr>
                    @endif

                    @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>