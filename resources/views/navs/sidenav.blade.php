<nav class="sidenav shadow-none border-end sidenav-light no-print">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Main</div>
            <!-- Sidenav Accordion (Dashboard)-->
            <a class="nav-link @if(Request::is('dashboard')) active @endif" href="{{ route('dashboard') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-bolt"></i></div>
                Dashboard
            </a>

            @if(auth()->user()->role === "admin")
                <!-- Admin: Pet Owners -->
                <a class="nav-link @if(Str::startsWith(request()->path(), ['manageowners', 'addowner', 'profileowner'])) active @endif" href="{{ route('owners.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Pet Owners
                </a>

                <!-- Admin: Pets -->
                <a class="nav-link @if(Str::startsWith(request()->path(), ['managepet', 'addpet', 'profilepet', 'editpet', 'petinfo'])) active @endif" href="{{ route('pet.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-paw"></i></div>
                    Pets
                </a>

                <!-- Admin: Veterinarians -->
                <a class="nav-link @if(Str::startsWith(request()->path(), ['managedoctor', 'adddoctor', 'profiledoctor', 'securitydoctor', 'adminsettingsdoctor'])) active @endif" href="{{ route('doctor.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user-doctor"></i></div>
                    Veterinarians
                </a>

                <!-- Admin: Appointments -->
                <a class="nav-link @if(Str::startsWith(request()->path(), ['manageappointments', 'todayappointments', 'finishedappointments', 'pendingappointments', 'cancelledappointments', 'viewappointments'])) active @endif" href="{{ route('appointments.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-calendar-plus"></i></div>
                    Appointments
                </a>
            @endif

            <!-- Calendar -->
            <a class="nav-link @if(Request::is('manageschedules')) active @endif" href="{{ route('schedules.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                Calendar
            </a>

            @if(auth()->user()->role === "staff" || auth()->user()->role === "admin")
                <div class="sidenav-menu-heading">Point of Sales</div>
                <!-- POS: Billing -->
                <a class="nav-link @if(Request::is('billing*')) active @endif" href="{{ route('billing') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    Billing & Services
                </a>
                <!-- POS Dashboard -->
                <a class="nav-link @if(Request::is('pos')) active @endif" href="{{ route('pos') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-table-columns"></i></div>
                    POS Dashboard
                </a>

                <div class="sidenav-menu-heading">Inventory</div>
                <!-- Inventory: Products -->
                <a class="nav-link @if(Request::is('products')) active @endif" href="{{ route('products.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                    Manage Products
                </a>
                <!-- Inventory: Suppliers -->
                <a class="nav-link @if(Request::is('suppliers')) active @endif" href="{{ route('suppliers.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                    Manage Suppliers
                </a>
                <!-- Inventory: Categories -->
                    <a class="nav-link @if(Request::is('categories')) active @endif" href="{{ route('categories.index') }}">
                        <div class="nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                        Manage Categories
                    </a>

                <!-- Inventory: Units -->
                <a class="nav-link @if(Request::is('units')) active @endif" href="{{ route('units.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-balance-scale"></i></div>
                    Manage Units
                </a>
            @endif

            @if(auth()->user()->role === "admin")
                <div class="sidenav-menu-heading">User Management</div>
                <!-- User Management: Admin -->
                <a class="nav-link @if(Request::is('um/admin*')) active @endif" href="{{ route('admin.manage') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Administrator
                </a>
                <!-- User Management: Staff -->
                <a class="nav-link @if(Request::is('um/staff*')) active @endif" href="{{ route('staffs.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Staff
                </a>
            @endif
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>
