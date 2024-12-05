<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Stock Report</title>
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
            <h1>VetIS</h1>
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
                <h2 class="mb-0">Item Stock Report</h2>
                <p class="text-primary">{{\App\Models\Products::where('id',$productId)->first()->product_name}}</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Stock ID</th>
                    <th>Expiry Date</th>
                    <th>Supplier</th>
                    <th>Supplier Price</th>
                    <th>SRP</th>
                    <th>Stocks Purchased</th>
                    <th>Stocks Left</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ sprintf("STK-%05d", $stock->id)}}</td>
                        <td>{{ $stock->expiry_date ?? 'No Expiry Date' }}</td>
                        <td>{{ \App\Models\Suppliers::where('id', $stock->supplier_id)->first()->supplier_name }}</td>
                        <td>Php {{$stock->price}}</td>
                        <td>Php {{\App\Models\Products::where('id', $productId)->first()->price}}</td>
                        <td>{{$stock->stock. ' ' . \App\Models\Unit::where('id',$stock->unit)->first()->unit_name}}</td>
                        <td>{{$stock->stock - $stock->subtracted_stock. ' ' . \App\Models\Unit::where('id',$stock->unit)->first()->unit_name}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
