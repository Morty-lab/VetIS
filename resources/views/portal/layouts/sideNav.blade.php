<nav class="sidenav shadow-none border-end sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="dashboard-3.html#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="dashboard-3.html#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a>
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Main</div>
            <a class="nav-link {{ request()->routeIs('portal.dashboard*') ? 'active' : '' }}" href="{{ route('portal.dashboard') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-house"></i></div>
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('portal.mypets*') ? 'active' : '' }}" href="{{ route('portal.mypets') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-paw"></i></div>
                My Pets
            </a>
            <a class="nav-link {{ request()->routeIs('portal.appointments*') ? 'active' : '' }}" href="{{ route('portal.appointments') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-calendar-check"></i></div>
                Appointment
            </a>
            <div class="sidenav-menu-heading">Others</div>
            <a class="nav-link {{ request()->routeIs('portal.profile*') ? 'active' : '' }}" href="{{route('portal.profile')}}">
                <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                My Profile
            </a>
            <!-- <a class="nav-link" href="">
                <div class="nav-link-icon"><i class="fa-solid fa-shield-dog"></i></div>
                Services
            </a>
            <a class="nav-link" href="">
                <div class="nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                Contact Us
            </a> -->
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{\Illuminate\Support\Facades\Auth::user()->name}}</div>
        </div>
    </div>
</nav>