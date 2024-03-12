{{-- @extends('layouts.app') --}}

{{-- @section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css')}}" />
@endsection --}}

{{-- @section('sidnav') --}}
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo demo">
          @include('_partials.macros')
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">VetIS</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
            fill="currentColor"
            fill-opacity="0.6" />
          <path
            d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
            fill="currentColor"
            fill-opacity="0.38" />
        </svg>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Page -->
      <li class="menu-header fw-medium mt-0">
        <span class="menu-header-text" data-i18n="Components">Home</span>
      </li>
      <li class="menu-item active">
        <a href="index.html" class="menu-link">
          <span class="menu-icon mdi mdi-home"></span>
          <div data-i18n="Page 1">Dashboard</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-paw"></i>
          <div data-i18n="Page 2">Pets</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="app-ecommerce-dashboard.html" class="menu-link">
                <div data-i18n="Dashboard">Manage Pet</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="app-ecommerce-dashboard.html" class="menu-link">
                <div data-i18n="Dashboard">Add Pet</div>
              </a>
            </li>
          </ul>
      </li>
      @if (auth()->user()->role == "admin")
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-account"></i>
          <div data-i18n="Page 2">Doctors</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="app-ecommerce-dashboard.html" class="menu-link">
                <div data-i18n="Dashboard">Manage Doctor</div>
              </a>
            </li>
            <li class="menu-item">
              <a  class="menu-link" data-bs-toggle="modal" data-bs-target="#editUser">
                <div data-i18n="Dashboard" >Add Doctor</div>
              </a>
              @include('modals.addUserModal')

            </li>
          </ul>
      </li>
      @endif

      <li class="menu-item">
        <a href="page-2.html" class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-calendar-account"></i>

          <div data-i18n="Page 2">Doctor's Schedule</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-calendar"></i>
          <div data-i18n="Page 2">Appointment</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="app-ecommerce-product-list.html" class="menu-link">
              <div data-i18n="Product list">Manage Appointments</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="app-ecommerce-product-list.html" class="menu-link">
              <div data-i18n="Product list">Add Appointments</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-header fw-medium mt-2">
        <span class="menu-header-text" data-i18n="Components">Point of Sales</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-view-dashboard"></i>
          <div data-i18n="Page 2">POS Dashboard</div>
        </a>
      </li>
      <li class="menu-header fw-medium mt-2">
        <span class="menu-header-text" data-i18n="Components">Inventory</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-truck"></i>
          <div data-i18n="Page 2">Manage Suppliers</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="app-ecommerce-product-list.html" class="menu-link">
              <div data-i18n="Product list">All Supplier</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="app-ecommerce-product-list.html" class="menu-link">
              <div data-i18n="Product list">Add Supplier</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-list-box"></i>
          <div data-i18n="Page 2">Manage Products</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="app-ecommerce-product-list.html" class="menu-link">
              <div data-i18n="Product list">All Products</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="app-ecommerce-product-list.html" class="menu-link">
              <div data-i18n="Product list">Add Products</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-header fw-medium mt-4">
        <span class="menu-header-text" data-i18n="Components">User Management</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-account"></i>
          <div data-i18n="Page 2">Admin/Owner</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-account"></i>
          <div data-i18n="Page 2">Sub-Admin/User</div>
        </a>
      </li>
      <li class="menu-header fw-medium mt-4">
        <span class="menu-header-text" data-i18n="Components">Reports</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-note"></i>
          <div data-i18n="Page 2">Pets</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-note"></i>
          <div data-i18n="Page 2">Vaccination/Immunization</div>
        </a>
      </li>
    </ul>
  </aside>
{{-- @endsection --}}

{{-- @section('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js')}}"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection
 --}}
