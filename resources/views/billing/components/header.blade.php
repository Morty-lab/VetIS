<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4 pb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="d-flex text-primary mb-0">
                    <p class="mb-0">{{ $title }}</p>
                    <div class="nav-link-icon ms-2">{!! $icon !!}</div>
                </h1>
                <div class="">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('billing') }}" class="btn btn-outline-primary me-2 {{ request()->is('billing') ? 'active' : '' }}">
                            <i class="fa-solid fa-file-invoice me-1"></i>Billing
                        </a>
                        <a href="{{ route('billing.services') }}" class="btn btn-outline-primary me-2 {{ request()->is('billing/services*') ? 'active' : '' }}">
                            <i class="fa-solid fa-shield-dog me-1"></i>Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>