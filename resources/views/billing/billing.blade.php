@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('billing.components.header', ['title' => 'Billing'], ['icon' => '<i class="fa-solid fa-file-invoice"></i>'])
<div class="container-xl px-4 mt-4">
    <div class="card shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">Billing History
            <a href="{{route('billing.add')}}" class=" btn btn-primary me-2"><i class="fa-solid fa-file-invoice me-1"></i>Add Billing</a>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($billings as $billing)
                    <tr>
                        <td>{{sprintf("VETISBill-%05d",$billing->id)}}</td>
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
                                <div class="badge bg-success text-white rounded-pill">Fully Paid</div>
                            @elseif ($billing->total_paid > 0)
                                <div class="badge bg-secondary text-white rounded-pill">Partially Paid</div>
                            @else
                                <div class="badge bg-danger text-white rounded-pill">Pending Payment</div>
                            @endif
                        </td>

                        <td>
                            <a href="" class="btn btn-datatable btn-primary px-5 py-3">Open</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection