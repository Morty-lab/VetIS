<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Receipt</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header h1,
        .footer p {
            margin: 0;
        }

        .details,
        .services,
        .payment-info,
        .billing-history {
            margin-bottom: 20px;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .text-primary {
            color: #007bff;
        }

        .badge {
            padding: 5px 10px;
            background-color: #d9f7ff;
            border-radius: 20px;
            font-size: 12px;
        }

        .print-btn {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .container {
                margin: 0;
                padding: 0;
                width: 100%;
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }

            table {
                width: 100%;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: none;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .services-table td {
            border-top: 1px solid #ddd;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .container {
                margin: 0;
                padding: 0;
                width: 100%;
                max-width: 100%;
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }

            table {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header mb-4">
            <h2>Pruderich Veterinary Clinic</h2>
            <p>Purok - 3, Dologon, Maramag, Bukidnon</p>
        </div>
        <hr>
        <!-- Billing Info Section -->
        <div class="details mb-3">
            <div><strong>Billing Number:</strong> {{sprintf("#VETISBILL-%05d",$billing->id )}}</div>
            <div><strong>Date:</strong> {{ \Carbon\Carbon::parse($billing->created_at)->format('F d, Y') }}</div>
        </div>

        <!-- Owner and Pet Info Section -->
        <div class="details row mb-4">
            <div class="col-md-6">
                <strong>Owner Details</strong>
                <div><strong>Name:</strong> {{$owner->client_name}}</div>
                <div><strong>Address:</strong> {{$owner->client_address}}</div>
                <div><strong>Phone:</strong> {{$owner->client_no}}</div>
            </div>
            <div class="col-md-6">
                <strong>Pet Details</strong>
                <div><strong>Name:</strong> {{$pet->pet_name}}</div>
                <div><strong>Breed:</strong> {{$pet->pet_breed}}</div>
                @php
                    $pet = \App\Models\Pets::find($pet->id); // Retrieve the specific pet instance
                    $petage = $pet ? $pet->age : 'Unknown';
                @endphp
                <div><strong>Age:</strong> {{$petage}} years</div>
            </div>
        </div>

        <!-- Services Availed Section as Table -->
        <div class="services mb-4">
            <h3>Services Availed</h3>
            <table class="services-table">
                <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($services_availed as $s)
                    @php
                        // Find the service that matches the current service_id
                        $service = $services->firstWhere('id', $s->service_id);
                        $total += $service->service_price;
                    @endphp
                    @if($service)
                        <tr>
                            <td>{{ $service->service_name }}</td>
                            <td>x{{ $s->quantity ?? 1 }}</td>
                            <td class="text-primary">₱{{ number_format($service->service_price, 2) }}</td>
                        </tr>
                    @endif

                @endforeach


                </tbody>
            </table>
        </div>

        <!-- Billing History Section -->
        <div class="billing-history mb-4">
            <h3>Billing History</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Billing Number</th>
                        <th>Date</th>
                        <th>Payable</th>
                        <th>Amount Paid</th>
                        <th>Remaining Balance</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($payments as $p)
                    <tr>
                        <td>{{ sprintf("#VetIS-%05d", $p->id)}}</td>
                        <td>{{\Carbon\Carbon::parse($p->created_at)->format('m/d/Y')}}</td>
                        <td class="text-primary">₱{{$p->amount_to_pay}}</td>
                        <td class="text-primary">₱{{$p->cash_given}}</td>
                        <td class="text-primary">₱{{$p->amount_to_pay - $p->cash_given}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <!-- Payment Info Section -->
        <div class="payment-info mb-4">
            <div><strong>Payment Type:</strong> {{ ucwords(str_replace('_', ' ', $billing->payment_type)) }}</div>
            <div><strong>Due Date:</strong> {{\Carbon\Carbon::parse($billing->due_date)->format('m/d/Y') ?? ''}}</div>

            @php
                // Check payment type
                if ($billing->payment_type === 'full_payment') {
                    // Full Payment directly shows Fully Paid
                    $fullyPaid = true;
                } else {
                    // Calculate remaining balance
                    $totalPayable = $billing->total_payable;
                    $totalPaid = $billing->total_paid;

                    $remainingBalance = $totalPayable - $totalPaid;

                    // Check if payments array is not empty
                    if (!$payments->isEmpty()) {
                        $paymentsSum = $payments->sum('cash_given');
                        $remainingBalance -= $paymentsSum;
                    }

                    // Determine if fully paid
                    $fullyPaid = $remainingBalance <= 0;
                }
            @endphp

            @if($fullyPaid)
                <!-- Fully Paid Badge -->
                <div><strong>Remaining Balance:</strong> <span class="text-danger">0.00</span></div>
            @else
                <!-- Remaining Balance -->

                <div><strong>Remaining Balance:</strong> <span class="text-danger">₱{{ number_format($remainingBalance, 2) }}</span></div>
            @endif

        </div>

        <!-- Footer Section -->
        <div class="footer mb-4">
            <button class="print-btn" onclick="window.print()">Print Receipt</button>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
