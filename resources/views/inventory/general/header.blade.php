<header class="mt-n10 pt-10 bg-white border-bottom">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row">
                <div class="col-md-2">
                    <p class="mb-0">Inventory</p>
                    <h1 class="d-flex text-primary">
                        <p>{{ $title }}</p>
                        <div class="nav-link-icon ms-2">{!! $icon !!}</div>
                    </h1>
                </div>
                <div class="col-md-10">
                    <div class="d-flex mt-2 justify-content-end">
                        <a href="{{route('products.index')}}" class=" btn @if(Request::is('products')) btn-primary @else btn-outline-primary @endif me-2"><i class="fa-solid fa-box-open me-1"></i>Products</a>
                        <a href="{{route('suppliers.index')}}" class=" btn @if(Request::is('suppliers')) btn-primary @else btn-outline-primary @endif me-2"><i class="fa-solid fa-truck-field me-1"></i> Suppliers</a>
                        <!-- <a href="{{route('categories.index')}}" class=" btn @if(Request::is('categories')) btn-primary @else btn-outline-primary @endif me-2"><i class="fa-solid fa-tags me-1"></i> Stocks</a> -->
                        <!-- <a href="{{route('units.index')}}" class=" btn @if(Request::is('units')) btn-primary @else btn-outline-primary @endif me-2">Units</a> -->
                        <!-- <a href="{{route('units.index')}}" class=" btn btn-outline-primary me-2"><i class="fa-solid fa-chart-simple me-1"></i> Sales</a> -->
                        <div class="dropdown">
                            <button href="" class="btn btn-outline-primary @if(Request::is('units') || Request::is('categories')) active @endif" id="dropdownInventory" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>:</b></button>
                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownInventory">
                                <a href="{{route('categories.index')}}" class="dropdown-item @if(Request::is('categories')) text-primary @endif"><i class="fa-solid fa-tags me-1"></i> Categories</a>
                                <a href="{{route('units.index')}}" class="dropdown-item @if(Request::is('units')) text-primary @endif" href=""><i class="fa-solid fa-balance-scale me-1"></i>Units</a>
                                <!-- <div class="dropdown-divider"></div> -->
                                <!-- <a class="dropdown-item" href=""><i class="fa-solid fa-print me-2"></i>Print</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- <div class="w-100 bg-white border-bottom">
    <div class="container-xl px-4 py-2 d-flex justify-content-end">
    </div>
</div> -->