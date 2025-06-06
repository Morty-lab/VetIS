<nav class="topnav navbar navbar-expand shadow-none border-bottom justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="{{ route('portal.dashboard') }}"> <img class="me-0" src="{{ asset('assets/img/favicon.png') }}" alt="PetHub Logo" style=" width: 40px; height: auto; margin-right: 8px;"> PetHub | Portal</a>
    <!-- Navbar Items-->
    @php
    $client = \App\Models\Clients::getClientByUserID(\Illuminate\Support\Facades\Auth::user()->id)
    @endphp
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{ $client->client_profile_picture ? asset('storage/' . $client->client_profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png') }}" /></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">

                    <img class="dropdown-user-img" src="{{ $client->client_profile_picture ? asset('storage/' . $client->client_profile_picture) : asset('assets/img/illustrations/profiles/profile-1.png') }}" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">{{$client->client_name}}</div>
                        <div class="dropdown-user-details-email text-primary">{{Auth::user()->email}}</div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('portal.profile')}}">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </button>
                </form>

            </div>
        </li>
    </ul>
</nav>
