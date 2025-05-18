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
                <h3 class="mb-0 text-primary">Replenishment Reports</h3>
            </div>
            <div class="">
                <nav class="nav nav-borders">
                    <a class="nav-link nav-tab {{ request()->is('monthly-sales') ? 'active' : '' }}" href="#monthly-sales">
                        Monthly Replenishment
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div class="card shadow-none mt-4" id="monthlySalesCard" style="display: none;">
        <div class="card-header">
            Monthly Replenishment Report
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
                            <a class="btn btn-datatable btn-primary px-5 py-3" href="{{ route('reports.replenishment.print',['date'=>$month->month]) }}" target="_blank">
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
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        const cards = {
            'monthly-sales': document.getElementById('monthlySalesCard'),
        };

        // Ensure Pet Profile is active initially
        document.querySelector('.nav-link[href="#monthly-sales"]').classList.add('active');
        cards['monthly-sales'].style.display = 'block'; // Show Pet Profile Card by default

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Hide all cards
                Object.values(cards).forEach(card => card.style.display = 'none');

                // Show the clicked tab's corresponding card
                const targetCard = tab.getAttribute('href').substring(1);
                if (cards[targetCard]) {
                    cards[targetCard].style.display = 'block';
                }
            });
        });

        // Trigger the click on the Pet Profile tab to show it initially
        document.querySelector('.nav-tab.active').click();
    });
</script>
<script>
    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "Y-m-d"
    });
</script>
@endsection
