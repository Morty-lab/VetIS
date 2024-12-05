<nav class="sidenav shadow-none border-end sidenav-light no-print">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Main</div>

            <!-- Admin: Dashboard -->
            @if(auth()->user()->role === "admin")
                <a class="nav-link @if(Request::is('dashboard')) active @endif" href="{{ route('dashboard') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-bolt"></i></div>
                    Dashboard
                </a>
            @endif

            <!-- Pet Owners (Accessible to Admin, Secretary) -->
            @if(in_array(auth()->user()->role, ['admin', 'secretary']))
                <a class="nav-link @if(Str::startsWith(request()->path(), ['manageowners', 'addowner', 'profileowner'])) active @endif" href="{{ route('owners.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Pet Owners
                </a>
            @endif

            <!-- Pets (Accessible to Admin, Secretary, Veterinarian) -->
            @if(in_array(auth()->user()->role, ['admin', 'secretary', 'veterinarian']))
                <a class="nav-link @if(Str::startsWith(request()->path(), ['managepet', 'addpet', 'profilepet', 'editpet', 'petinfo'])) active @endif" href="{{ route('pet.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-paw"></i></div>
                    Pets
                </a>
            @endif

            <!-- Veterinarians (Accessible to Admin) -->
            @if(auth()->user()->role === "admin")
                <a class="nav-link @if(Str::startsWith(request()->path(), ['managedoctor', 'adddoctor', 'profiledoctor', 'securitydoctor', 'adminsettingsdoctor'])) active @endif" href="{{ route('doctor.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user-doctor"></i></div>
                    Veterinarians
                </a>
            @endif

            <!-- Appointments (Accessible to Admin, Secretary, Veterinarian) -->
            @if(in_array(auth()->user()->role, ['admin', 'secretary', 'veterinarian']))
                <a class="nav-link @if(Str::startsWith(request()->path(), ['manageappointments', 'todayappointments', 'finishedappointments', 'pendingappointments', 'cancelledappointments', 'viewappointments'])) active @endif" href="{{ route('appointments.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-calendar-plus"></i></div>
                    Appointments
                </a>
            @endif

            <!-- Calendar (Accessible to Admin) -->
            @if(auth()->user()->role === "admin")
                <a class="nav-link @if(Request::is('manageschedules')) active @endif" href="{{ route('schedules.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                    Calendar
                </a>
            @endif

            <!-- Reports (Accessible to Admin, Secretary) -->
            @if(in_array(auth()->user()->role, ['admin', 'secretary']))
                <a class="nav-link @if(Request::is('reports*')) active @endif" href="{{ route('reports.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                    Reports
                </a>
            @endif


            <!-- Billing & Services (Accessible to Cashier, Admin) -->
            @if(in_array(auth()->user()->role, ['cashier', 'admin']))
                <div class="sidenav-menu-heading">Point of Sales</div>

                <a class="nav-link @if(Request::is('billing*')) active @endif" href="{{ route('billing') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    Billing & Services
                </a>
            @endif

            <!-- POS Dashboard (Accessible to Cashier, Admin) -->
            @if(in_array(auth()->user()->role, ['cashier', 'admin']))
                <a class="nav-link @if(Request::is('pos')) active @endif" href="{{ route('pos') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-table-columns"></i></div>
                    POS Dashboard
                </a>
            @endif


            <!-- Manage Products (Accessible to Staff, Admin) -->
            @if(in_array(auth()->user()->role, ['staff', 'admin']))
                <div class="sidenav-menu-heading">Inventory</div>

                <a class="nav-link @if(Request::is('products')) active @endif" href="{{ route('products.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                    Manage Products
                </a>
            @endif

            <!-- Manage Suppliers (Accessible to Staff, Admin) -->
            @if(in_array(auth()->user()->role, ['staff', 'admin']))
                <a class="nav-link @if(Request::is('suppliers')) active @endif" href="{{ route('suppliers.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                    Manage Suppliers
                </a>
            @endif

            <!-- Manage Categories (Accessible to Staff, Admin) -->
            @if(in_array(auth()->user()->role, ['staff', 'admin']))
                <a class="nav-link @if(Request::is('categories')) active @endif" href="{{ route('categories.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    Manage Categories
                </a>
            @endif

            <!-- Manage Units (Accessible to Staff, Admin) -->
            @if(in_array(auth()->user()->role, ['staff', 'admin']))
                <a class="nav-link @if(Request::is('units')) active @endif" href="{{ route('units.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-balance-scale"></i></div>
                    Manage Units
                </a>
            @endif


            <!-- Admin: User Management (Accessible to Admin) -->
            @if(auth()->user()->role === "admin")
                <div class="sidenav-menu-heading">User Management</div>

                <a class="nav-link @if(Request::is('um/admin*')) active @endif" href="{{ route('admin.manage') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Administrator
                </a>
            @endif

            <!-- Staff: User Management (Accessible to Admin) -->
            @if(auth()->user()->role === "admin")
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
