@extends('layouts.app')

@section('styles')

@endsection

@section('content')
@include('billing.components.header', ['title' => 'Billing'], ['icon' => '<i class="fa-solid fa-file-invoice"></i>'])
{{--  Medication Qty --}}
<div class="modal fade" id="addBilling" tabindex="-1" role="dialog" aria-labelledby="addBilling"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <form action="{{route('billing.add')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Billing</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <label for="" class="mb-1">Pet Owner</label>
                            <select class="form-select select-pet-owner-billing" id="pet" name="pet_owner" required
                                    data-placeholder="Select a Pet Owner">
                                <option value=""></option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="mb-1">Veterinarian</label>
                            <select class="form-select select-veterinarian-billing" id="vet" name="vet" required
                                    data-placeholder="Select a Veterinarian">
                                <option value=""></option>
                                @foreach($vets as $vet)
                                    <option value="{{ $vet->id }}">
                                        Dr. {{ $vet->firstname }} {{ $vet->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary w-100" type="submit">Start Billing</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container-xl px-4 mt-4">
    <div class="card shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">Billing History
            <a data-bs-toggle="modal"
               data-bs-target="#addBilling" class=" btn btn-primary me-2">Add Billing</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Invoice/Billing Number</th>
                        <th>Billing Date</th>
                        <th>Pet Owner</th>
{{--                        <th>Pet/s</th>--}}
{{--                        <th>Availed Services</th>--}}
{{--                        <th>Payable</th>--}}
{{--                        <th>Remaining Balance</th>--}}
                        <th>Payment Status</th>
{{--                        <th>Due Date</th>--}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billings as $billing)
                    <tr>
                        <td>{{sprintf("#%05d",$billing->id)}}</td>
                        <td>{{$billing->created_at}}</td>
                        <td>
                            {{ $clients->firstWhere('id', $billing->user_id)?->client_name ?? 'Unknown' }}
                        </td>
{{--                        <td>--}}
{{--                            {{ $pets->firstWhere('id', $billing->pet_id)?->pet_name ?? 'Unknown' }}--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{ \App\Models\BillingServices::where('billing_id', $billing->id)->count() }}--}}
{{--                        </td>--}}
{{--                        <td>₱ {{ number_format($billing->total_payable, 2) }}</td>--}}
{{--                        <td>₱ {{ number_format($billing->total_payable - $billing->total_paid, 2) }}</td>--}}
                        <td>
                            @if ($billing->total_paid >= $billing->total_payable)
                            <div class="badge bg-success-soft text-success text-sm rounded-pill">Fully Paid</div>
                            @elseif ($billing->total_paid > 0)
                            <div class="badge bg-secondary-soft text-secondary text-sm rounded-pill">Partially Paid</div>
                            @else
                            <div class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending Payment</div>
                            @endif
                        </td>
{{--                        <td>{{\Carbon\Carbon::parse($billing->due_date)->format('M d, Y')}}</td>--}}
                        <td>
                            <a href="{{route('billing.view',['billingID' => $billing->id])}}" class="btn btn-datatable btn-primary px-5 py-3"><i class="fa-solid fa-eye me-2"></i>View</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    @if(request('openModal') === 'add')
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('addBilling'));
                myModal.show();
            });
        </script>
    @endif
@endsection
