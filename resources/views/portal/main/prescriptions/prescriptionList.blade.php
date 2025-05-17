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
                            <th>Date Created</th>
                            <th>Pet</th>
                            <th>Pet Type</th>
                            <th>Veterinarian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($prescriptions as $prescription)
                        <tr>
                            <td>{{\Carbon\Carbon::parse(time: $prescription->record_date)->format("F d, Y")}}</td>
                            <td>{{\App\Models\Pets::where('id',$prescription->petID)->first()->pet_name}}</td>
                            <td>{{\App\Models\Pets::where('id',$prescription->petID)->first()->pet_type}}</td>
                            <td>{{\App\Models\Doctor::getName($prescription->doctorID) }} </td>
                            <td><a class="btn btn-primary" href="{{route('portal.prescription.print', ['recordID' => $prescription->id])}}" target="_blank"><i class="fa-solid fa-print me-2"></i> Print</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
