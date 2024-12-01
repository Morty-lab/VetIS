@php use App\Models\Clients;use Illuminate\Support\Facades\Auth; @endphp
@extends('portal.layouts.app')
@section('outerContent')

<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary mb-0">Prescriptions</h1>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-none border mb-5" id="prescriptionsCard">
            <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Prescriptions</span>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Prescription ID</th>
                            <th>Pet Name</th>
                            <th>Prescription Details</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>Fluffy</td>
                            <td>John Doe</td>
                            <td>December 2, 2024</td>
                            <td><a class="btn btn-primary" href="{{route('portal.prescription.print')}}" target="_blank">Print</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection