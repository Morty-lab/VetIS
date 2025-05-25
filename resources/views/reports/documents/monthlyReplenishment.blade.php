<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Replenishment Report</title>
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
                <h2 class="mb-0">Replenishment Report</h2>
                <p>for {{ \Carbon\Carbon::parse(request()->query('date'))->format('M Y') }}</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    {{-- <th>Date</th> --}}
                    <th>Barcode</th>
                    <th>Brand Name</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Total Replenished Stock</th>
                    <th>Total Remaining Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $stock)
                @php
                 $unit = \App\Models\Unit::where('id', $stock->unit)->first()->unit_name
                @endphp
                    <tr>
                        <td>{{ $stock->SKU }}</td>
                        <td>{{ $stock->brand }}</td>
                        <td>{{ $stock->product_name }}</td>
                        <td>{{ \App\Models\Category::where('id', $stock->product_category)->first()->category_name }}</td>
                        <td>{{ $totalStocks[$stock->id] ?? 0 }} {{ $unit }}/s</td>
                        <td>{{ $totalStocks[$stock->id] - $totalSubtractedStocks[$stock->id] ?? 0 }} {{ $unit }}/s </td>
                    </tr>
                @endforeach



        </table>
    </div>
</body>

</html>
