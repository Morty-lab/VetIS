    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Account)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <!-- Sidenav Link (Alerts)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="dashboard-1.html#!">
                    <div class="nav-link-icon"><i data-feather="bell"></i></div>
                    Alerts
                    <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                </a>
                <!-- Sidenav Link (Messages)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="dashboard-1.html#!">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Messages
                    <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                </a>
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Main</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <a class="nav-link  @if(Request::is('dashboard')) active @endif"" href=" /dashboard">
                    <div class="nav-link-icon"><i class="fa-solid fa-bolt"></i></div>
                    Dashboard
                </a>


                @if (auth()->user()->role == "admin")
                <a class="nav-link  @if(Str::startsWith(request()->path(), ['manageowners', 'addowner', 'profileowner'])) active @endif" href="/manageowners">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Pet Owners
                </a>
                @endif

                <a class="nav-link @if(Request::is('managepet') || Request::is('addpet') || Request::is('profilepet') || Request::is('editpet')) active @endif" href="/managepet">

                    <div class="nav-link-icon"><i class="fa-solid fa-paw"></i></div>
                    Pets
                </a>

                @if (auth()->user()->role == "admin")
                <a class="nav-link @if(Str::startsWith(request()->path(), ['managedoctor', 'adddoctor', 'profiledoctor', 'securitydoctor', 'adminsettingsdoctor'])) active @endif" " href=" {{route('doctor.index')}}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user-doctor"></i></div>
                    Veterinarians
                </a>

                <div class="collapse" id="collapseDoctors" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- Nested Sidenav Accordion (Pages -> Account)-->
                        <a class="nav-link" href="/managedoctor">
                            Manage Veterinarians
                        </a>
                    </nav>
                </div>
                @endif

                <a class="nav-link @if(Request::is('manageappointments')) active @endif" href="{{route('appointments.index')}}">
                    <div class="nav-link-icon"><i class="fa-solid fa-calendar-plus"></i></div>
                    Appointments
                </a>

                <a class="nav-link @if(Request::is('manageschedules')) active @endif" href="/manageschedules">
                    <div class="nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                    Calendar
                </a>

                <!-- <a class="nav-link" href="#">
                    <div class="nav-link-icon"><i class="fa-solid fa-bell"></i></div>
                    Notifications
                </a>

                <a class="nav-link" href="#">
                    <div class="nav-link-icon"><i class="fa-solid fa-message"></i></div>
                    Messages
                </a> -->

                @if (auth()->user()->role == "staff" || auth()->user()->role == "admin")
                <div class="sidenav-menu-heading">Point of Sales</div>

                <a class="nav-link" href="">

                    <div class="nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    Billing
                </a>

                <a class="nav-link" href="{{route('pos')}}">

                    <div class="nav-link-icon"><i class="fa-solid fa-table-columns"></i></div>
                    POS Dashboard
                </a>
                @endif

                <div class="sidenav-menu-heading">Inventory</div>

                <a class="nav-link collapsed  @if(Request::is('suppliers')) active @endif" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseSuppliers" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                    Manage Suppliers
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSuppliers" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- Nested Sidenav Accordion (Pages -> Account)-->
                        <a class="nav-link" href="{{route('suppliers.index')}}">
                            All Suppliers
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed @if(Request::is('products')) active @endif" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                    Manage Products
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduct" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- Nested Sidenav Accordion (Pages -> Account)-->
                        <a class="nav-link" href="{{route('products.index')}}">
                            All Products
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed @if(Request::is('units')) active @endif" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUnits" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i class="fa-solid fa-balance-scale"></i></div>
                    Manage Units
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUnits" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- Nested Sidenav Accordion (Pages -> Account)-->
                        <a class="nav-link" href="{{route('units.index')}}">
                            All Units
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed @if(Request::is('categories')) active @endif" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    Manage Categories
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCategory" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- Nested Sidenav Accordion (Pages -> Account)-->
                        <a class="nav-link" href="{{route('categories.index')}}">
                            All Categories
                        </a>
                    </nav>
                </div>

                @if (auth()->user()->role == "admin")

                <div class="sidenav-menu-heading">User Management</div>

                <a class="nav-link @if(Request::is('um/admin*')) active @endif" href="/um/admin">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Administrator
                </a>
                <a class="nav-link @if(Request::is('um/client*')) active @endif" href="/um/client">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Client/Pet Owners
                </a>
                <a class="nav-link @if(Request::is('um/staff*')) active @endif" href="/um/staff">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></i></div>
                    Staffs
                </a>
                @endif
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">{{Auth::user()->name}}</div>
            </div>
        </div>
    </nav>