@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('billing.components.header', ['title' => 'Billing'], ['icon' => '<i class="fa-solid fa-file-invoice"></i>'])
<div class="container-xl px-4 mt-4">
    <div class="card shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">Billing History
            <a href="{{route('billing.add')}}" class=" btn btn-primary me-2">Add Billing</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Invoice/Billing Number</th>
                        <th>Billing Date</th>
                        <th>Owner</th>
                        <th>Pet</th>
                        <th>Availed Services</th>
                        <th>Payable</th>
                        <th>Remaining Balance</th>
                        <th>Payment Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billings as $billing)
                    <tr>
                        <td>{{sprintf("VETISBILL-%05d",$billing->id)}}</td>
                        <td>{{$billing->created_at}}</td>
                        <td>
                            {{ $clients->firstWhere('id', $billing->user_id)?->client_name ?? 'Unknown' }}
                        </td>
                        <td>
                            {{ $pets->firstWhere('id', $billing->pet_id)?->pet_name ?? 'Unknown' }}
                        </td>
                        <td>
                            {{ \App\Models\BillingServices::where('billing_id', $billing->id)->count() }}
                        </td>
                        <td>₱ {{ number_format($billing->total_payable, 2) }}</td>
                        <td>₱ {{ number_format($billing->total_payable - $billing->total_paid, 2) }}</td>

                        <td>
                            @if ($billing->total_paid >= $billing->total_payable)
                            <div class="badge bg-success-soft text-success text-sm rounded-pill">Fully Paid</div>
                            @elseif ($billing->total_paid > 0)
                            <div class="badge bg-secondary-soft text-secondary text-sm rounded-pill">Partially Paid</div>
                            @else
                            <div class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending Payment</div>
                            @endif
                        </td>
                        <td>{{\Carbon\Carbon::parse($billing->due_date)->format('M d, Y')}}</td>
                        <td>
                            <a href="{{route('billing.view',['billingID' => $billing->id])}}" class="btn btn-datatable btn-primary px-5 py-3">Open</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
