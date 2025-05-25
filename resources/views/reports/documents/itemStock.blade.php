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
            <h1>PetHub</h1>
            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
        </div>
    </div>
    <div class="document bg-white">
        <div class="d-flex justify-content-between">
            <div class="text-start">
                <p class="mb-0 text-lg text-dark">Pruderich Veterinary Clinic</p>
                <p>Purok - 3, Dologon, Maramag, Bukidnon, Philippines</p>
            </div>
            <div class=" text-end">
                <h2 class="mb-1">Item Stock Report</h2>
                <p class="text-primary mb-1">{{\App\Models\Products::where('id',$productId)->first()->brand}} | {{\App\Models\Products::where('id',$productId)->first()->product_name}}</p>
                <p class="mb-0">{{\App\Models\Products::where('id',$productId)->first()->SKU}}</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Date Added</th>
                    <th>Barcode</th>
                    <th>Expiry Date</th>
                    <th>Supplier Name</th>
                    <th>Supplier Price</th>
                    <th>Selling Price</th>
                    <th>Total Stock</th>
                    <th>Available Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks->sortByDesc('created_at') as $stock)
                <tr>
                    <td>{{ $stock->created_at->format('M d, Y h:i A') }}</td>
                    <td>{{\App\Models\Products::where('id', $productId)->first()->SKU}}</td>
                    <td>
                        {{ $stock->expiry_date ? \Carbon\Carbon::parse($stock->expiry_date)->format('F d, Y') : 'No Expiry Date' }}
                    </td>
                    <td>{{ \App\Models\Suppliers::where('id', $stock->supplier_id)->first()->supplier_name }}</td>
                    <td>₱ {{$stock->supplier_price}}</td>
                    <td>₱ {{$stock->price}}</td>
                    <td>{{$stock->stock}}</td>
                    <td>{{$stock->stock - $stock->subtracted_stock}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>