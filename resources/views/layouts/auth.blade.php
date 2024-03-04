<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-starter">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | {{ config('variables.systemSuffix') ? config('variables.systemSuffix') : 'SystemSuffix'}}</title></title>

    <meta name="description" content="{{ config('variables.systemDescription') ? config('variables.systemDescription') : '' }}" />
    <meta name="keywords" content="{{ config('variable.systemKeyword') ? config('variables.systemKeyword') : '' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../../assets/vendor/fonts/materialdesignicons.css" />
    <!-- <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" /> -->

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    @yield('styles')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

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
                    <a href="app-ecommerce-dashboard.html" class="menu-link">
                      <div data-i18n="Dashboard">Add Doctor</div>
                    </a>
                  </li>
                </ul>
            </li>
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
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Style Switcher -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item dropdown-style-switcher dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="mdi mdi-24px"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-bottom dropdown-styles">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- / Style Switcher-->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-account-outline me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cog-outline me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 mdi mdi-credit-card-outline me-2"></i>
                          <span class="flex-grow-1 align-middle ms-1">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button class="dropdown-item">
                        <i class="mdi mdi-power me-2"></i>
                        <span class="align-middle">Log Out</span>
                        </button>
                      </form>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                  <div class="mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                    <a href="https://pixinvent.com" target="_blank" class="footer-link fw-medium">Pixinvent</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a
                      href="https://demos.pixinvent.com/materialize-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    @yield('scripts')
  </body>
</html>