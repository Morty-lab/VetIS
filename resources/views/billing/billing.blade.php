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
                <tfoot>
                    <tr>
                        <th>Billing #</th>
                        <th>Date</th>
                        <th>Owner</th>
                        <th>Pet</th>
                        <th>Services Availed</th>
                        <th>Payable</th>
                        <th>Remaining</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>PH20324232</td>
                        <td>04/19/2024</td>
                        <td>Kent Invento</td>
                        <td>Lexie</td>
                        <td>2</td>
                        <td>₱ 2000</td>
                        <td>₱ 0.00</td>
                        <td>
                            <!-- <div class="badge bg-success text-white rounded-pill">Fully Paid</div> -->
                            <div class="badge bg-secondary text-white rounded-pill">Partially Paid</div>
                        </td>
                        <td>
                            <a href="" class="btn btn-datatable btn-primary px-5 py-3">Open</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection