<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report</title>
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

        @media print {
            .table-bordered {
                border: 1px solid #000;
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
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mb-0">Pruderich Veterinary Clinic</h1>
                <p class="mb-1">Purok - 3, Dologon, Maramag, Bukidnon, Philippines</p>
                <h2 class="mb-1">Financial Report</h2>
                <h4 class="mb-1">{{ \Carbon\Carbon::parse(request()->query('date', now()))->format('F Y') }}</h4>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Services</th>
                    <th>Total Transactions</th>
                    <th>Total Income</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $date = \Carbon\Carbon::parse(request()->query('date', now()));
                    $billings = \App\Models\Billing::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->get();

                    $services = \App\Models\BillingServices::whereIn('billing_id', $billings->pluck('id'))
                        ->get()
                        ->filter(function ($service) {
                            return \App\Models\Services::where('id', $service->service_id)
                                ->where('service_type', 'services')
                                ->exists();
                        })
                        ->groupBy('service_id')
                        ->map(function ($services) {
                            return [
                                'service_name' => \App\Models\Services::where('id', $services->first()->service_id)->value('service_name'),
                                'total_transactions' => $services->count(),
                                'total_income' => $services->sum('service_price'),
                            ];
                        });
                @endphp

                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service['service_name'] }}</td>
                        <td>{{ $service['total_transactions'] }}</td>
                        <td>&#x20B1; {{ number_format($service['total_income'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5 mb-2">Top 5 Most Requested Services</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Frequency</th>
                    <th>Income Generated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services->sortByDesc('total_transactions')->take(5) as $service)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $service['service_name'] }}</td>
                        <td>{{ $service['total_transactions'] }}</td>
                        <td>&#x20B1; {{ number_format($service['total_income'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5 mb-2">Top-Selling Products</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-grid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Units Sold</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $transactions = \App\Models\TransactionModel::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->get()
                            ->pluck('id');
                        $transactionDetails = \App\Models\TransactionDetailsModel::whereIn('transaction_id', $transactions)
                            ->get()
                            ->groupBy('product_id')
                            ->map(function ($transactionDetails) {
                                return [
                                    'product_name' => \App\Models\Products::where('id', $transactionDetails->first()->product_id)->value('product_name'),
                                    'quantity' => $transactionDetails->sum('quantity'),
                                    'total_sales' => $transactionDetails->sum(function ($transactionDetail) {
                                        return $transactionDetail->quantity * $transactionDetail->price;
                                    }),
                                ];
                            })
                            ->sortByDesc('total_sales')
                            ->take(5);
                    @endphp
                    @foreach ($transactionDetails as $index => $transactionDetail)
                        <tr>
                            <td>{{ $index  }}</td>
                            <td>{{ $transactionDetail['product_name'] }}</td>
                            <td>{{ $transactionDetail['quantity'] }}</td>
                            <td>&#x20B1; {{ number_format($transactionDetail['total_sales'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center text-lg text-dark">
                            Total Income: &#x20B1;
                            {{ number_format($services->sum('total_income') + $transactionDetails->sum('total_sales'), 2) }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td><strong>Primary Income Source</strong></td>
                        <td>Services (50% of total income)</td>
                    </tr>
                    <tr>
                        <td><strong>Top Service</strong></td>
                        <td>General Check-Up</td>
                    </tr>
                    <tr>
                        <td><strong>Top Product</strong></td>
                        <td>Pet Food (Small Pack)</td>
                    </tr> --}}
                </tbody>
            </table>

        </div>
    </div>
</body>


</html>
