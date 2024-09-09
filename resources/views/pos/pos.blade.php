@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal - VetIS</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
    @yield('styles')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables/datatables-simple-demo.js') }}"></script>

    <style>
        .pt-6 {
            padding-top: 4rem;
        }

        #sticky-sidebar {
            position: fixed;
            max-width: 25%;
        }

        .receipt-cutout {
            content: '';
            bottom: -10px;
            width: 100%;
            height: 10px;
            transform: rotate(180deg);
            background: linear-gradient(45deg,
                    transparent 33.333%,
                    #f2f6fc 33.333%,
                    #f2f6fc 66.667%,
                    transparent 66.667%),
                linear-gradient(-45deg,
                    transparent 33.333%,
                    #f2f6fc 33.333%,
                    #f2f6fc 66.667%, transparent 66.667%);
            background-size: 20px 40px;
        }

        .thank-you-purchase {
            color: #0061f2;
            font-size: 1.8rem;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>

<body class="nav-fixed">

    <!-- Modals -->
    <!-- Quantity Modal -->
    @foreach ($products as $product)
    <div class="modal fade" id="enterQty{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="enterQty" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enterQtyLabel">Enter Quantity</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="item-description ps-2">
                        <div class="row">
                            <div class="col">
                                Item: {{ $product->product_name }}
                                <br>
                                Category: {{ $product->category->category_name }}
                            </div>
                            <div class="col">
                                SKU: {{ $product->id }}
                                <br>
                                Price: <span class="text-primary">{{ $product->price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="number" id="quantityInput" class="form-control" placeholder="Enter Quantity" oninput="setQuantity(this.value)">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal"
                        onclick="addItem({
                        'sku' : {{ $product->id }},
                        'name' : '{{ $product->product_name }}',
                        'price' : {{ $product->price }},
                        'qty' : document.getElementById('quantityInput').value
                        })">Add
                        Product</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Select Product Modal -->
    <div class="modal fade" id="exampleModalXl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Products List</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-4" placeholder="Enter Product Name, SKU" oninput="search()">
                    <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Stocks</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($products as $product)
                                    @php
                                        $stock = 0;
                                        $expiredStocks = 0;
                                           if ($product->stocks->isNotEmpty() && $product->stocks->first()->status == 1){
                                               $allStocks = $product->stocks;

                                                  foreach ($allStocks as $i){
                                                      if( $i->expiry_date == null ){
                                                       $stock += $i->stock;
                                                      }

                                                      if( $i->expiry_date != null && $i->expiry_date > Carbon::today()){
                                                       $stock += $i->stock;
                                                      }

                                                      if( $i->expiry_date != null && $i->expiry_date <= Carbon::today()){
                                                       $expiredStocks += $i->stock;
                                                      }

                                                  }


                                           }
                                    @endphp
                                    @if($product->status == 0 || $stock == 0)
                                        @continue
                                    @endif
                                <tr data-bs-toggle="modal" data-bs-target="#enterQty{{ $product->id }}"
                                    style="cursor: pointer;">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td> {{ $stock." stocks Available "}} <br> @if($expiredStocks != 0) {{$expiredStocks." stock Expired"}} @endif
                                    </td>
                                    <td>{{ $product->price }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Select Customer Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModal"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer List</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-4" placeholder="Enter Customer">
                    <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>CustomerID</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($customers as $customer)
                                <tr style="cursor: pointer;" onclick="setCustomer('{{ $customer->client_name }}' , {{ $customer->id }})" data-bs-dismiss="modal">
                                    <td>{{ $customer->client_name }}</td>
                                    <td>{{ $customer->id }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Discount Modal -->
    <div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="discountModal"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enterQtyLabel">Enter Discount Code</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="number" class="form-control" placeholder="VETISDSTXX-XXXX-XX">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button">Add Discount Code</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Void Transaction Modal -->
    <div class="modal fade" id="voidTransactionModal" tabindex="-1" role="dialog"
        aria-labelledby="voidTransactionModal" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Void Transaction</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to void this transaction?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-bs-dismiss="modal">Cancel</button><button class="btn btn-danger" type="button"
                        data-bs-toggle="modal" data-bs-target="#voidTransactionCodeModal">Void Transaction</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Void Code Modal -->
    <div class="modal fade" id="voidTransactionCodeModal" tabindex="-1" role="dialog"
        aria-labelledby="voidTransactionCodeModal" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Enter Void Code</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="***************">
                </div>
                <div class="modal-footer"><button class="btn btn-danger" type="button">Void Transaction</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Payment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-5 bg-white border-end">
                            <div class="col-12 pb-3 px-2">
                                <div class="receipt-section">
                                    <div class="receipt-display mt-3 bg-light p-4">
                                        <p class="text-center h3 text-primary">PetHub: Vet Clinic</p>
                                        <hr>
                                        <div
                                            class="subtotal-section d-flex justify-content-between align-items-center">
                                            <p class="mb-0">Transaction No.</p>
                                            <p class="text-md text-grey mb-0">1032</p>
                                        </div>
                                        <div
                                            class="subtotal-section d-flex justify-content-between align-items-center">
                                            <p class="mb-0">Date</p>
                                            <p class="text-md text-grey mb-0"> {{ \Carbon\Carbon::now()->format('m/d/yy | h:iA') }}</p>
                                        </div>
                                        <div
                                            class="subtotal-section d-flex justify-content-between align-items-center">
                                            <p class="mb-0">Customer</p>
                                            <p class="text-md text-grey mb-0 customer">Juan Dela Cruz</p>
                                        </div>
                                        <hr>
                                        <div
                                            class="subtotal-section d-flex justify-content-between align-items-center">
                                            <p class="mb-0">Sub Total</p>
                                            <p class="text-lg text-grey mb-0 sub-total">1000</p>
                                        </div>
                                        <div
                                            class="discount-section d-flex justify-content-between align-items-center">
                                            <p class="mb-0 ">Discount %</p>
                                            <p class="text-lg text-grey mb-0 discount"></p>
                                        </div>
                                        <hr>
                                        <div class="total-section d-flex justify-content-between align-items-center">
                                            <p class="mb-0 ">Total</p>
                                            <p class="text-xl text-blue mb-0 grand-total">0</p>
                                        </div>
                                    </div>
                                    <div class="receipt-cutout"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-2 mx-auto">
                            <!-- Mawala ni pag ma bayran na -->
                            <form action="{{route('pos.pay')}}" id="paymentForm" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="">Cash Given</label>
                                        <input type="text" class="form-control" id="cashGivenInput">
                                        <input type="hidden" name="customer_id" id="customer_id">
                                        <input type="hidden" name="sub_total" id="sub_total">
                                        <input type="hidden" name="discount" id="discount">
                                        <input type="hidden" name="products" id="products">
                                        <button type="button" class="btn btn-primary mt-3 w-100" onclick="handlePayment()">Enter</button>
                                        <hr class="mt-3">
                                    </div>
                                </div>
                            </form>

                            <!-- --- -->

                            <!-- Mo gawas rani sila if nabayaran na -->
                            <div style="display:none" id="change">
                                <div class="thank-you-purchase fw-500 mt-3">
                                    Thank you for your Purchase!
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <p class="mb-0">Total:</p>
                                    <p class="text-lg mb-0 fw-400 grand-total"></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Cash Given:</p>
                                    <p class="text-lg mb-0 fw-400 " id="cash"></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Change:</p>
                                    <p class="display-6 text-blue mb-0 h5 fw-500 " id="change-cash"></p>
                                </div>
                            </div>

{{--                            <hr class="mt-3">--}}
{{--                            <a href="" class="btn btn-outline-primary mt-3 w-100">New Transaction</a> --}}
                            <!-- ---- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- POS -->

    <nav class="topnav navbar navbar-expand border-bottom justify-content-between justify-content-sm-start navbar-light bg-white"
        id="sidenavAccordion">
        <p class="navbar-brand px-4 fw-700">VetIS <span class="fw-400 text-gray-600">| POS Terminal</span></p>
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><img class="img-fluid"
                        src="assets/img/illustrations/profiles/profile-1.png"></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png">
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">Valerie Luna</div>
                            <div class="dropdown-user-details-email">vluna@aol.com</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="account-profile.html#!">
                        <div class="dropdown-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-settings">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                </path>
                            </svg></div>
                        Account
                    </a>
                    <a class="dropdown-item" href="{{route('dashboard')}}">
                        <div class="dropdown-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9L12 2l9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        Back to Dashboard
                    </a>
                    <a class="dropdown-item" href="account-profile.html#!">
                        <div class="dropdown-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="main">
        <div class="row min-vh-100 g-0">
            <div class="col-3 bg-white border-end">
                <div class="col-12 px-4 pt-6 d-flex flex-column h-100 justify-content-between" id="sticky-sidebar">
                    <div class="receipt-section">
                        <div class="receipt-display mt-3 bg-light p-4">
                            <p class="text-center h3 text-primary">PetHub: Vet Clinic</p>
                            <hr>
                            <div class="subtotal-section d-flex justify-content-between align-items-center">
                                <p class="mb-0">Transaction No.</p>
                                <p class="text-md text-grey mb-0">1032</p>
                            </div>
                            <div class="subtotal-section d-flex justify-content-between align-items-center">
                                <p class="mb-0">Date</p>
                                <p class="text-md text-grey mb-0"> {{ \Carbon\Carbon::now()->format('m/d/yy | h:iA') }}</p>
                            </div>
                            <div class="subtotal-section d-flex justify-content-between align-items-center">
                                <p class="mb-0">Customer</p>
                                <p class="text-md text-grey mb-0 customer">Juan Dela Cruz</p>
                            </div>
                            <hr>
                            <div class="subtotal-section d-flex justify-content-between align-items-center">
                                <p class="mb-0 ">Sub Total</p>
                                <p class="text-lg text-grey mb-0 sub-total">0</p>
                            </div>
                            <div class="discount-section d-flex justify-content-between align-items-center">
                                <p class="mb-0">Discount %</p>
                                <p class="text-lg text-grey mb-0 discount">5%</p>
                            </div>
                            <hr>
                            <div class="total-section d-flex justify-content-between align-items-center">
                                <p class="mb-0">Total</p>
                                <p class="text-xl text-blue mb-0 grand-total">0</p>
                            </div>
                        </div>
                        <div class="receipt-cutout"></div>
                    </div>
                    <div class="col-12">
                        <div class="proceed-payment">
                            <a href="#" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal"
                                data-bs-target="#paymentModal">Proceed Payment</a>
                        </div>
                        <!-- Only shows when transaction is completed -->
                        <div class="new-transaction">
                            <a href="#" class="btn btn-outline-primary w-100 mb-4"
                                onclick="newTransaction()">New Transaction</a>
                        </div>
                        <!-- -- -->
                    </div>
                </div>
            </div>
            <div class="col-9 position-relative">
                <div class="px-4 py-4 d-flex justify-content-between bg-white border-bottom"
                    style="padding-top: 5rem !important;">
                    <a href="" class="form-control ms-1"
                        style="width: 300px !important; text-decoration: none;" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModalXl">
                        <i class="fas fa-search me-2"></i>
                        Enter Product</a>
                    <div class="dropdown">
                        <button class="btn btn-outline-dark me-1 dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Options</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#customerModal"
                                    class="dropdown-item">Customer</a></li>
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#discountModal"
                                    class="dropdown-item">Discount</a></li>
                            <hr class="my-2">
                            <li><a href="#" class="dropdown-item text-primary">Services Billing</a></li>
                            <hr class="my-2">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#voidTransactionModal"
                                    class="dropdown-item text-danger">Void Transaction</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row px-5 py-4">
                    <div class="card shadow-none pt-2 pb-2 px-3 rounded-3">
                        <table class="table bg-white">
                            <thead class="thead-dark text-primary">
                                <tr>
                                    <th>Item</th>
                                    <th>SKU</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody id="ItemContainer">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/pos.js') }}"></script>
    <script>
        var focusInputOnModalShown = function() {
            var modal = document.getElementById('exampleModalXl');
            var input = modal.querySelector('input');

            modal.addEventListener('shown.bs.modal', function() {
                input.focus();
            });
        };
        document.addEventListener('DOMContentLoaded', focusInputOnModalShown);
    </script>


</body>

</html>
