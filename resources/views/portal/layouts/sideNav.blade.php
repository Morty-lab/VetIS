<nav class="sidenav shadow-none border-end sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
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