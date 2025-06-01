<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Monthly Sales Report</title>
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
                <h2 class="mb-0">POS Monthly Sales Report</h2>
                <p>{{ \Carbon\Carbon::parse($date)->format('F Y') }}</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Transactions</th>
                    <th>Item Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    @if ($date === \Carbon\Carbon::parse($sale->date)->format('Y-m'))
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($sale->date)->format('F j, Y') }}</td>
                            <td>{{ \App\Models\TransactionModel::whereDate('created_at', $sale->date)->count() }} Transactions</td>
                            <td>{{ number_format($sale->items_sold) }}</td>
                            <td>₱{{ number_format($sale->total_sales, 2) }}</td>

                        </tr>
                    @endif
                @endforeach


            </tbody>
        </table>
        <div class="row">
            <div class="col-md-9 text-end">

            </div>
            <div class="col-md-3 text-end">
               <h3 class="mb-0">Total Sales</h3>
                @php
                    $monthly = \App\Models\TransactionModel::getMonthlySalesReport();
                @endphp
                <h3 class="text-primary">₱{{ number_format($monthly->where('month', $date)->first()->total_sales, 2) }}</h3>
            </div>
        </div>
    </div>
</body>

</html>
