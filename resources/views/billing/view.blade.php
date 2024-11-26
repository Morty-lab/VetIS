@extends('layouts.app')
@section('content')
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="#">Billing</a></li>
                    <li class="breadcrumb-item active">View Billing</li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="{{route('billing')}}"><span class="px-2"><i class="fa-solid fa-arrow-left"></i></span> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card shadow-none mb-4">
                <div class="card-header">Billing Information</div>
                <div class="card-body">
                    <!-- Billing Info -->
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <h1 class="mb-0">Pruderich Veterinary Clinic</h1>
                            <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7 mt-1 mt-md-0">
                                    <label for="billing_number" class="form-label mb-0 text-primary">Billing Number</label>
                                    <p class="mb-0">{{sprintf("#VETISBILL-%05d",$billing->id )}}</p>
                                </div>
                                <div class="col-md-5 mt-1 mt-md-0">
                                    <label for="billing_date" class="form-label mb-0 text-primary">Date</label>
                                    <p class="mb-0">{{ \Carbon\Carbon::parse($billing->created_at)->format('F d, Y') }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mx-0">
                    <!-- Owner and Pet Info -->
                    <div class="row g-4 mb-3">
                        <!-- Owner Details -->
                        <div class="col-md-6">
                            <label for="owner" class="form-label mb-1 fw-bold text-primary">Owner Details</label>
                            <div class="mb-1">
                                <span class="fw-semibold">Name:</span>  {{$owner->client_name}}
                            </div>
                            <div class="mb-1">
                                <span class="fw-semibold">Address:</span> {{$owner->client_address}}
                            </div>
                            <div class="mb-1">
                                <span class="fw-semibold">Phone:</span> {{$owner->client_no}}
                            </div>
                        </div>

                        <!-- Pet Details -->
                        <div class="col-md-6">
                            <label for="pet" class="form-label mb-1 fw-bold text-primary">Pet Details</label>
                            <div class="mb-1">
                                <span class="fw-semibold">Name:</span> {{$pet->pet_name}}
                            </div>
                            <div class="mb-1">
                                <span class="fw-semibold">Breed:</span> {{$pet->pet_breed}}
                            </div>
                            @php
                                $pet = \App\Models\Pets::find($pet->id); // Retrieve the specific pet instance
                                $petage = $pet ? $pet->age : 'Unknown';
                            @endphp
                            <div class="mb-1">
                                <span class="fw-semibold">Age:</span> {{$petage}}
                            </div>
                        </div>
                    </div>
                    <hr class="mt-5 mb-3">
                    <!-- Services Availed -->
                    <div class="row mb-3 rounded mx-0">
                        <label class="form-label fw-bold text-primary p-0">Services Availed</label>
                        <ul class="list-group p-0">
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
                                    <li class="list-group-item border-0 bg-transparent py-1 px-2 text-body">
                                        <div class="row">
                                            <div class="col-5">{{ $service->service_name }}</div>
                                            <div class="col-3 text-center">x{{ $s->quantity ?? 1 }}</div>
                                            <div class="col-4 text-end text-primary">₱{{ number_format($service->service_price, 2) }}</div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                            <!-- Total Row -->
                            <li class="list-group-item border-0 bg-transparent py-1 pt-3 px-2 text-body fw-bold">
                                <div class="row">
                                    <div class="col-md-7 text-end"></div>
                                    <div class="col-md-5 text-end border-top pt-3">Total: <span class="ms-3 text-primary">₱{{$total}}</span></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr class="mt-0">

                    <!-- <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="payable" class="form-label mb-1">Total Payable</label>
                            <p id="payable" class="p-2 ps-3 text-primary fw-bold text-lg rounded border">₱1,000.00</p>
                        </div>
                        <div class="col-md-6">
                            <label for="amount_paid" class="form-label mb-1">Amount Paid</label>
                            <p class="p-2 ps-3 rounded border">₱500.00</p>
                        </div>
                    </div> -->

                    <!-- Remaining Balance -->
                    <!-- <div class="row g-3 mt-1">
                        <div class="col-md-12">
                            <label for="remaining_balance" class="form-label mb-1 fw-bold">Remaining Balance</label>
                            <p class="rounded text-danger fw-bold">₱500.00</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <!-- Payment Information -->
            <div class="card shadow-none">
                <div class="card-header">Payment Information</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="paymentType" class="form-label fw-bold text-primary">Payment Type</label>
                            <p class="mb-1 badge text-sm rounded-pill
                                @if($billing->payment_type === 'full_payment') bg-success-soft text-success
                                @elseif($billing->payment_type === 'partial_payment') bg-warning-soft text-warning
                                @elseif($billing->payment_type === 'pending_payment') bg-danger-soft text-danger
                                @else bg-secondary-soft text-secondary
                                @endif">
                                {{ ucwords(str_replace('_', ' ', $billing->payment_type)) }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label for="due_date" class="form-label fw-bold text-primary">Due Date</label>
                            <p class="mb-1">{{\Carbon\Carbon::parse($billing->due_date)->format('F d,Y') ?? ''}}</p>
                        </div>
                        <hr class="m-0 mt-2">
                        <div class="col-md-6">
                            <label for="service_total" class="form-label fw-bold text-primary">Total</label>
                            <p class="rounded fw-bold">₱{{$total}}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="remaining_balance" class="form-label fw-bold text-primary">Remaining Balance</label>
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
                                <div class="badge bg-success-soft text-success text-sm rounded-pill">Fully Paid</div>
                            @else
                                <!-- Remaining Balance -->
                                <p class="rounded text-danger fw-bold">₱{{ number_format($remainingBalance, 2) }}</p>
                            @endif
                        </div>

                        <hr class="m-0">
                        <div class="col-md-12 d-flex justify-content-end">
                            <!-- Trigger Modal -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartialPaymentModal">
                                Add Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow-none mt-4">
                <div class="card-header">Payment History</div>
                <div class="card-body">
                    <table class="" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Billing Number</th>
                                <th>Date</th>
                                <th>Payable</th>
                                <th>Amount Paid</th>
                                <th>Remaining Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $p)
                            <tr>
                                <td>{{ sprintf("#VetIS-%05d", $p->id)}}</td>
                                <td>{{\Carbon\Carbon::parse($p->created_at)->format('m/d/Y')}}</td>
                                <td>₱ {{$p->amount_to_pay}}</td>
                                <td>₱ {{$p->cash_given}}</td>
                                <td>₱ {{$p->amount_to_pay - $p->cash_given}}</td>
                                <td>
                                    @php
                                        // Calculate the remaining balance
                                        $remainingBalance = $p->amount_to_pay - $p->cash_given;
                                    @endphp

                                    @if($remainingBalance <= 0)
                                        <!-- Fully Paid Badge -->
                                        <div class="badge bg-success-soft text-success text-sm rounded-pill">Fully Paid</div>
                                    @else
                                        <!-- Partially Paid Badge -->
                                        <div class="badge bg-secondary-soft text-secondary text-sm rounded-pill">Partially Paid</div>
                                    @endif
                                </td>

                                <td><a href="{{ route('billing.print',['billingID' => $billing->id]) }}" target="_blank" class="btn btn-datatable"><i class="fa-solid fa-print"></i></a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPartialPaymentModal" tabindex="-1" aria-labelledby="addPartialPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('billing.addPayment', ['billingID' => $billing->id])}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartialPaymentModalLabel">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Remaining Balance Section -->
                    <div class="mb-3">
                        <label for="remaining_balance" class="form-label mb-1">Remaining Balance</label>
                        <p id="remaining_balance" class="p-0 mb-2 fw-bold text-danger"  placeholder="Remaining Balance">₱{{number_format($remainingBalance, 2) }}</p>
                    </div>
                    <hr class="my-3">
                    <!-- Payment Amount Section -->
                    <div class="mb-3">
                        <label for="amount_given" class="form-label">Cash Given</label>
                        <input type="number" name="cash_given" id="amount_given" class="form-control" min="1" placeholder="Enter amount given" required>
                        <input type="hidden" name="amount_to_pay" value={{$remainingBalance}}>
                    </div>
{{--                    <div class="mb-3">--}}
{{--                        <label for="partial_payment" class="form-label">Amount to Pay</label>--}}
{{--                        <input type="number" name="partial_payment" id="partial_payment" class="form-control" min="1" max="500" placeholder="Enter amount to pay" required>--}}
{{--                    </div>--}}
{{--                    <div class="mb-3">--}}
{{--                        <label for="change" class="form-label">Change</label>--}}
{{--                        <input type="number" name="change" id="change" class="form-control" readonly placeholder="Change will be calculated automatically">--}}
{{--                    </div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    // Update the remaining balance dynamically
    document.getElementById('amount_given').addEventListener('input', calculateChange);
    document.getElementById('partial_payment').addEventListener('input', calculateChange);

    function calculateChange() {
        let amountGiven = parseFloat(document.getElementById('amount_given').value) || 0;
        let partialPayment = parseFloat(document.getElementById('partial_payment').value) || 0;

        // Ensure partial payment does not exceed amount given
        if (partialPayment > amountGiven) {
            partialPayment = amountGiven; // Set partial payment to the amount given
            document.getElementById('partial_payment').value = partialPayment.toFixed(2); // Update the input field
        }

        // Define the total amount due
        let totalDue = 500; // Update this as needed (it could be dynamic)

        // Ensure partial payment does not exceed remaining balance
        if (partialPayment > totalDue) {
            partialPayment = totalDue; // Set partial payment to total due
            document.getElementById('partial_payment').value = partialPayment.toFixed(2); // Update the input field
        }

        // Calculate change based on the given amount and partial payment
        let change = amountGiven - partialPayment;

        // Set the change value in the 'change' input field
        document.getElementById('change').value = change >= 0 ? change.toFixed(2) : '0.00';

        // Calculate remaining balance (assuming total due is 500)
        let remainingBalance = totalDue - partialPayment; // Update remaining balance

        // Set the remaining balance value in the 'remaining_balance' p tag
        document.getElementById('remaining_balance').textContent = `₱${remainingBalance.toFixed(2)}`;
    }
</script>
@endsection
