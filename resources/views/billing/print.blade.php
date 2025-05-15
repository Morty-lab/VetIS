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
            <div><strong>Billing Number:</strong> {{sprintf("#%05d",$billing->id )}}</div>
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
            {{-- <div class="col-md-6">
                <strong>Pet Details</strong>
                <div><strong>Name:</strong> {{$pet->pet_name}}</div>
                <div><strong>Breed:</strong> {{$pet->pet_breed}}</div>
                @php
                    $pet = \App\Models\Pets::find($pet->id); // Retrieve the specific pet instance
                    $petage = $pet ? $pet->age : 'Unknown';
                @endphp
                <div><strong>Age:</strong> {{$petage}} years</div>
            </div> --}}
        </div>

        <!-- Services Availed Section as Table -->
        <div class="services mb-4">
            <p class="fw-bold" style="font-size: 20px">Services Availed</p>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service/Medication</th>
                            <th>Pet</th>
                            <th>Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                
                        @foreach($services_availed as $s)
                            @php
                                $service = $services->firstWhere('id', $s->service_id);
                                $lineTotal = $service ? $service->service_price * ($s->quantity ?? 1) : 0;
                                $total += $lineTotal;
                            @endphp
                            @if($service)
                                <tr>
                                    <td>{{ $service->service_name }}</td>
                                    <td>Lexie</td>
                                    <td>₱{{ number_format($service->service_price, 2) }}</td>
                                    <td class="text-center">x{{ $s->quantity ?? 1 }}</td>
                                    <td class="text-end">₱{{ number_format($lineTotal, 2) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>       
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <div class="col-md-9 text-end">
                                <span class="fw-bold">Sub Total:</span>
                            </div>
                            <div class="col-md-3 text-end">
                                <span class="text-primary fw-bold me-2">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <div class="col-md-9 text-end">
                                <span class="fw-bold">Discount:</span>
                            </div>
                            <div class="col-md-3 text-end">
                                <span class="text-primary fw-bold me-2">3%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <div class="col-md-9 text-end">
                                <span class="fw-bold">Total:</span>
                            </div>
                            <div class="col-md-3 text-end">
                                <span class="text-primary fw-bold me-2">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>                 
            </div>             
        </div>

        <!-- Billing History Section -->
        <div class="billing-history mb-4">
            <p class="fw-bold" style="font-size: 20px">Billing History</p>
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
                        <td>{{ sprintf("#%05d", $p->id)}}</td>
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



{{--New Version--}}
{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Billing Form</title>--}}
{{--    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />--}}
{{--    <style>--}}
{{--        * { box-sizing: border-box; }--}}
{{--        body { font-family: Arial, sans-serif; font-size: 13px; margin: 20px; }--}}
{{--        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }--}}
{{--        th, td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: top; }--}}
{{--        h2 { font-size: 16px; margin: 30px 0 10px; }--}}
{{--        h3 { font-size: 14px; margin: 20px 0 8px; }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="text-center mb-3">--}}
{{--    <h4>Pruderich Veterinary Clinic</h4>--}}
{{--    <p>Purok - 3, Dologon, Maramag, Bukidnon | +63 917 620 0620</p>--}}
{{--</div>--}}
{{--<hr>--}}

{{--<div class="row gx-1 gy-1">--}}
{{--    <div class="col-6">--}}
{{--        <table>--}}
{{--            <tr><td>Billing No.: BILL-0001</td></tr>--}}
{{--            <tr><td>Date Issued: April 17, 2025</td></tr>--}}
{{--            <tr><td>Status: Paid</td></tr>--}}
{{--            <tr><td>Veterinarian: Dr. Jane Doe</td></tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    <div class="col-6">--}}
{{--        <table>--}}
{{--            <tr><td>Owner: Juan Dela Cruz</td></tr>--}}
{{--            <tr><td>Pet: Lexie (Dog)</td></tr>--}}
{{--            <tr><td>Contact No.: 09123456789</td></tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<h2>Billing Details</h2>--}}
{{--<table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>Medication / Service</th>--}}
{{--        <th>Pet</th>--}}
{{--        <th>Price</th>--}}
{{--        <th>Qty</th>--}}
{{--        <th>Total</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <td>1</td>--}}
{{--        <td>Consultation</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱300.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱300.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>2</td>--}}
{{--        <td>Skin Scraping</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱500.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱500.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>3</td>--}}
{{--        <td>Hydrocortisone Cream</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱250.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱250.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>4</td>--}}
{{--        <td>Omega-3 Supplement</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱400.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱400.00</td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--</table>--}}


{{--<h3>Summary</h3>--}}
{{--<table style="width: 50%; float: right;">--}}
{{--    <tr><td>Subtotal</td><td>₱1,450.00</td></tr>--}}
{{--    <tr><td>Discount</td><td>₱0.00</td></tr>--}}
{{--    <tr><td><strong>Total</strong></td><td><strong>₱1,450.00</strong></td></tr>--}}
{{--    <tr><td>Amount Paid</td><td>₱1,000.00</td></tr>--}}
{{--    <tr><td>Balance</td><td>₱450.00</td></tr>--}}
{{--    <tr><td><strong>Due Date</strong></td><td><strong>April 30, 2025</strong></td></tr>--}}
{{--    <tr><td>Payment Method</td><td>Cash</td></tr>--}}
{{--    <tr><td>Status</td><td><strong>Partially Paid</strong></td></tr>--}}
{{--</table>--}}

{{--<div style="clear: both;"></div>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}

{{-- Second Partial Payment --}}
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Billing Form - Partial Payment</title>--}}
{{--    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />--}}
{{--    <style>--}}
{{--        * { box-sizing: border-box; }--}}
{{--        body { font-family: Arial, sans-serif; font-size: 13px; margin: 20px; }--}}
{{--        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }--}}
{{--        th, td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: top; }--}}
{{--        h2 { font-size: 16px; margin: 30px 0 10px; }--}}
{{--        h3 { font-size: 14px; margin: 20px 0 8px; }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="text-center mb-3">--}}
{{--    <h4>Pruderich Veterinary Clinic</h4>--}}
{{--    <p>Purok - 3, Dologon, Maramag, Bukidnon | +63 917 620 0620</p>--}}
{{--</div>--}}
{{--<hr>--}}

{{--<div class="row gx-1 gy-1">--}}
{{--    <div class="col-6">--}}
{{--        <table>--}}
{{--            <tr><td>Billing No.: BILL-0004</td></tr>--}}
{{--            <tr><td>Reference: BILL-0002</td></tr>--}}
{{--            <tr><td>Date Issued: April 18, 2025</td></tr>--}}
{{--            <tr><td>Status: <strong>Partially Paid</strong></td></tr>--}}
{{--            <tr><td>Veterinarian: Dr. Jane Doe</td></tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    <div class="col-6">--}}
{{--        <table>--}}
{{--            <tr><td>Owner: Maria Santos</td></tr>--}}
{{--            <tr><td>Pet: Coco (Cat)</td></tr>--}}
{{--            <tr><td>Contact No.: 09987654321</td></tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<h2>Billing Details</h2>--}}
{{--<table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>Medication / Service</th>--}}
{{--        <th>Pet</th>--}}
{{--        <th>Price</th>--}}
{{--        <th>Qty</th>--}}
{{--        <th>Total</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <td>1</td>--}}
{{--        <td>Consultation</td>--}}
{{--        <td>Coco</td>--}}
{{--        <td>₱300.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱300.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>2</td>--}}
{{--        <td>Flea Treatment</td>--}}
{{--        <td>Coco</td>--}}
{{--        <td>₱700.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱700.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>3</td>--}}
{{--        <td>Vitamins</td>--}}
{{--        <td>Coco</td>--}}
{{--        <td>₱200.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱200.00</td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--</table>--}}

{{--<h3>Updated Payment Summary</h3>--}}
{{--<table style="width: 50%; float: right;">--}}
{{--    <tr><td>Total Amount</td><td>₱1,200.00</td></tr>--}}
{{--    <tr><td>Previous Payment</td><td>₱500.00</td></tr>--}}
{{--    <tr><td>Current Payment</td><td>₱300.00</td></tr>--}}
{{--    <tr><td><strong>Total Paid</strong></td><td><strong>₱800.00</strong></td></tr>--}}
{{--    <tr><td><strong>Balance</strong></td><td><strong>₱400.00</strong></td></tr>--}}
{{--    <tr><td>Date Paid</td><td>April 18, 2025</td></tr>--}}
{{--    <tr><td>Payment Method</td><td>Cash</td></tr>--}}
{{--    <tr><td>Status</td><td><strong>Partially Paid</strong></td></tr>--}}
{{--</table>--}}

{{--<div style="clear: both;"></div>--}}

{{--</body>--}}
{{--</html>--}}


{{--Final PArtial Payment--}}

{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Billing Form</title>--}}
{{--    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />--}}
{{--    <style>--}}
{{--        * { box-sizing: border-box; }--}}
{{--        body { font-family: Arial, sans-serif; font-size: 13px; margin: 20px; }--}}
{{--        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }--}}
{{--        th, td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: top; }--}}
{{--        h2 { font-size: 16px; margin: 30px 0 10px; }--}}
{{--        h3 { font-size: 14px; margin: 20px 0 8px; }--}}
{{--        .payment-history { margin-top: 30px; }--}}
{{--        .payment-history h4 { font-size: 14px; margin-bottom: 5px; }--}}
{{--        .payment-history table { width: 60%; }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="text-center mb-3">--}}
{{--    <h4>Pruderich Veterinary Clinic</h4>--}}
{{--    <p>Purok - 3, Dologon, Maramag, Bukidnon | +63 917 620 0620</p>--}}
{{--</div>--}}
{{--<hr>--}}

{{--<div class="row gx-1 gy-1">--}}
{{--    <div class="col-6">--}}
{{--        <table>--}}
{{--            <tr><td>Billing No.: BILL-0001</td></tr>--}}
{{--            <tr><td>Date Issued: April 17, 2025</td></tr>--}}
{{--            <tr><td>Status: Paid</td></tr>--}}
{{--            <tr><td>Veterinarian: Dr. Jane Doe</td></tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    <div class="col-6">--}}
{{--        <table>--}}
{{--            <tr><td>Owner: Juan Dela Cruz</td></tr>--}}
{{--            <tr><td>Pet: Lexie (Dog)</td></tr>--}}
{{--            <tr><td>Contact No.: 09123456789</td></tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<h2>Billing Details</h2>--}}
{{--<table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>Medication / Service</th>--}}
{{--        <th>Pet</th>--}}
{{--        <th>Price</th>--}}
{{--        <th>Qty</th>--}}
{{--        <th>Total</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <td>1</td>--}}
{{--        <td>Consultation</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱300.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱300.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>2</td>--}}
{{--        <td>Skin Scraping</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱500.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱500.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>3</td>--}}
{{--        <td>Hydrocortisone Cream</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱250.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱250.00</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>4</td>--}}
{{--        <td>Omega-3 Supplement</td>--}}
{{--        <td>Lexie</td>--}}
{{--        <td>₱400.00</td>--}}
{{--        <td>1</td>--}}
{{--        <td>₱400.00</td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--</table>--}}


{{--<h3>Summary</h3>--}}
{{--<table style="width: 50%; float: right;">--}}
{{--    <tr><td>Subtotal</td><td>₱1,450.00</td></tr>--}}
{{--    <tr><td>Discount</td><td>₱0.00</td></tr>--}}
{{--    <tr><td><strong>Total</strong></td><td><strong>₱1,450.00</strong></td></tr>--}}
{{--    <tr><td>Amount Paid</td><td>₱1,450.00</td></tr>--}}
{{--    <tr><td>Balance</td><td>₱0.00</td></tr>--}}
{{--    <tr><td><strong>Due Date</strong></td><td><strong>April 30, 2025</strong></td></tr>--}}
{{--    <tr><td>Payment Method</td><td>Cash</td></tr>--}}
{{--    <tr><td>Status</td><td><strong>Paid</strong></td></tr>--}}
{{--</table>--}}

{{--<div style="clear: both;"></div>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}

