@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="javascript:void(0);" onclick="history.back()"><span class="px-2">
                <i class="fa-solid fa-arrow-left"></i> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="card shadow-none p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3 class="mb-0 text-primary">Financial Reports</h3>
            </div>
        </div>
    </div>
    <div class="card shadow-none mt-4" id="monthlySalesCard">
        <div class="card-header">
            Monthly Financial Report
        </div>
        <div class="card-body">
            <table id="monthlySalesReportsTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($monthlyReports as $month)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($month->month)->format('F Y') }}</td>
                        <td>
                            <a class="btn btn-datatable btn-primary px-5 py-3" href="{{ route('reports.financial.print',['date'=>$month->month]) }}" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a>
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
<script>
    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "Y-m-d"
    });
</script>
@endsection
