<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4 pb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="d-flex text-primary mb-0">
                    <div class="nav-link-icon me-2">{!! $icon !!}</div>
                    <p class="mb-0">{{ $title }}</p>
                </h1>
                <div class="">
                    <div class="d-flex justify-content-end">

                        @if (in_array(auth()->user()->role, ['secretary', 'admin']))
                        <a href="{{ route('billing') }}" class="btn btn-outline-primary me-2 {{ request()->is('billing') ? 'active' : '' }}">
                            <i class="fa-solid fa-file-invoice me-1"></i>Billing
                        </a>
                            <a href="{{ route('billing.services') }}" class="btn btn-outline-primary me-2 {{ request()->is('billing/services*') ? 'active' : '' }}">
                                <i class="fa-solid fa-shield-dog me-1"></i>Services
                            </a>
                            <a href="{{ route('billing.fees') }}" class="btn btn-outline-primary me-2 {{ request()->is('billing/fees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-shield-dog me-1"></i>Fees
                            </a>
                            <a href="{{ route('billing.discounts') }}" class="btn btn-outline-primary me-2 {{ request()->is('billing/discounts*') ? 'active' : '' }}">
                                <i class="fa-solid fa-tag me-1"></i>Discounts
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
