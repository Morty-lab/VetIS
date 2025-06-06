<nav class="topnav navbar navbar-expand border-bottom justify-content-between justify-content-sm-start navbar-light bg-white"
    id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
            data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="{{ route('dashboard') }}">
        <img class="me-0" src="{{ asset('assets/img/favicon.png') }}" alt="PetHub Logo"
            style=" width: 40px; height: auto; margin-right: 8px;">
        <span class="fw-500">PetHub</span>
    </a> <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->
    <!-- <form class="form-inline me-auto d-none d-lg-block me-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-text"><i data-feather="search"></i></div>
        </div>
    </form> -->
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        <!-- <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="dashboard-1.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>

            <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </form>
            </div>
        </li> -->
        <!-- Alerts Dropdown -->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
                href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"><i data-feather="bell"></i></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                aria-labelledby="navbarDropdownAlerts">
                @php
                    $notifications = DB::table('notifications')
                        ->whereRaw('FIND_IN_SET(' . Auth::user()->id . ', visible_to)')
                        ->where('read', false)
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                @endphp
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="me-2" data-feather="bell"></i>
                    Notification Center
                </h6>
                @foreach ($notifications as $notif)
                    <a class="dropdown-item dropdown-notifications-item" href="{{ $notif->link }}">
                        <div class="dropdown-notifications-item-icon bg-{{ $notif->notification_type }}"><i
                                data-feather="activity"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">
                                {{ Carbon\Carbon::parse($notif->created_at)->format('F j, Y \a\\t g:i A') }}</div>
                            <div class="dropdown-notifications-item-content-text">{{ $notif->message }}</div>
                        </div>
                    </a>
                @endforeach


                <a class="dropdown-item dropdown-notifications-footer" href="{{ route('notifications.index') }}">View
                    All Notifications</a>
            </div>
        </li>

        <!-- Messages Dropdown-->
        <!-- <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="me-2" data-feather="mail"></i>
                    Message Center
                </h6>
                <a class="dropdown-item dropdown-notifications-item" href="dashboard-1.html#!">
                    <img class="dropdown-notifications-item-img" src="{{ asset('assets/img/illustrations/profiles/profile-2.png') }}" />
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        <div class="dropdown-notifications-item-content-details">Thomas Wilcox · 58m</div>
                    </div>
                </a>
                <a class="dropdown-item dropdown-notifications-item" href="dashboard-1.html#!">
                    <img class="dropdown-notifications-item-img" src="{{ asset('assets/img/illustrations/profiles/profile-3.png') }}" />
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        <div class="dropdown-notifications-item-content-details">Emily Fowler · 2d</div>
                    </div>
                </a>
                <a class="dropdown-item dropdown-notifications-item" href="dashboard-1.html#!">
                    <img class="dropdown-notifications-item-img" src="{{ asset('assets/img/illustrations/profiles/profile-4.png') }}" />
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        <div class="dropdown-notifications-item-content-details">Marshall Rosencrantz · 3d</div>
                    </div>
                </a>
                <a class="dropdown-item dropdown-notifications-item" href="dashboard-1.html#!">
                    <img class="dropdown-notifications-item-img" src="{{ asset('assets/img/illustrations/profiles/profile-5.png') }}" />
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        <div class="dropdown-notifications-item-content-details">Colby Newton · 3d</div>
                    </div>
                </a>
                <a class="dropdown-item dropdown-notifications-footer" href="dashboard-1.html#!">Read All Messages</a>
            </div>
        </li> -->
        <!-- User Dropdown-->
        @php
            $user = \App\Models\User::where('id', Auth::id())->first();
            switch ($user->role) {
                case 'admin':
                    $userInfo = \App\Models\Admin::where('user_id', $user->id)->first();
                    break;
                case 'veterinarian':
                    $userInfo = \App\Models\Doctor::where('user_id', $user->id)->first();
                    // $userInfo = \App\Models\Doctor::all();
                    break;
                case 'staff':
                case 'secretary':
                case 'cashier':
                    $userInfo = \App\Models\Staff::where('user_id', $user->id)->first();
                    break;
            }
        @endphp
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img class="img-fluid"
                    src="{{ $userInfo->profile_picture ? asset('storage/' . $userInfo->profile_picture)  : asset('assets/img/illustrations/profiles/profile-1.png') }}" />
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    {{-- {{ $userInfo }} --}}

                    <img class="dropdown-user-img"
                        src="{{ $userInfo->profile_picture ? asset('storage/' . $userInfo->profile_picture)  : asset('assets/img/illustrations/profiles/profile-1.png') }}" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">{{ $userInfo->firstname . ' ' . $userInfo->lastname }} </div>
                        <div class="dropdown-user-details-email"><a href="cdn-cgi/l/email-protection.html"
                                class="__cf_email__ text-muted"> {{ Auth::user()->email }} </a></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('profile.view') }}">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="dropdown-item" href="dashboard-1.html#!">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </button>
                </form>

            </div>
        </li>
    </ul>
</nav>
