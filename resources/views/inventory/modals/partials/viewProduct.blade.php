                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Product Information</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 px-0 pb-0">
                    <div class="border-bottom bg-white">
                        <div class="row mx-3">
                            <div class="col-md-4 pt-3 ps-0 border-end">
                                <div class="label">Product Name</div>
                                <h3 class="mb-3 text-primary">{{ $product->product_name }}</h3>
                            </div>
                            <div class="col-md-8 pt-3 pb-1">
                                <div class="row ps-2">
                                    <div class="col flex flex-row">
                                        <div class="label">Total Stocks</div>
                                        @php
                                            $productStock = \App\Models\Stocks::getAllStocksByProductId(
                                                $product->id,
                                            )->sum('stock');
                                            $subtracted = \App\Models\Stocks::getAllStocksByProductId(
                                                $product->id,
                                            )->sum('subtracted_stock');
                                        @endphp
                                        <p
                                            class="badge {{ $productStock - $subtracted == 0 ? 'bg-danger-soft text-danger' : 'bg-primary-soft text-primary' }} rounded-pill">

                                            {{ $productStock - $subtracted == 0 ? 'No' : $productStock - $subtracted }}
                                            Stocks Available
                                        </p>
                                    </div>
                                    <div class="col">
                                        <div class="label">Unit</div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">
                                            @foreach ($units as $u)
                                                @if ($u->id == $product->unit)
                                                    {{ $u->unit_name }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col flex flex-row">
                                        <div class="label">Category</div>
                                        <p class="badge bg-primary-soft text-primary rounded-pill">
                                            @foreach ($categories as $i)
                                                @if ($i->id == $product->product_category)
                                                    {{ $i->category_name }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-1 p-0">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-gray me-2" id="productInfoMenuButton"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i
                                                        class="fa-solid fa-ellipsis"></i></button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="productInfoMenuButton">
                                                    <button class="dropdown-item cursor-pointer edit-product-btn"
                                                        data-id="{{ $product->id }}">Edit
                                                        Product</button>
                                                    <button class="dropdown-item cursor-pointer delete-product-btn"
                                                        data-id="{{ $product->id }}">Delete
                                                        Product</button>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item cursor-pointer"
                                                        href="{{ route('reports.inventory.itemStock', ['product_id' => $product->id]) }}" target="_blank">Print</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="border-bottom bg-white d-flex d-flex justify-content-between align-items-center py-2 px-3">
                        <span class="text-primary">Stock List</span>
                        <div class="">
                            <button class="btn btn-primary add-stock-btn" data-id="{{ $product->id }}">Add Stock</button>
                        </div>
                    </div>
                    <div class=" card mt-4 mb-4 mx-3 shadow-none">
                        <div class="card-body">
                            <table id="inventoryStocksTable">
                                <thead>
                                    <tr>
                                        <th>Product Information</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $stockforproduct = \App\Models\Stocks::getAllStocksByProductId($product->id);
                                    @endphp
                                    @foreach ($stockforproduct->sortByDesc('created_at') as $stockP)
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12"><span
                                                            class="text-primary fw-600">{{ $product->product_name }}</span>
                                                    </div>
                                                    <div class="col-md-12">Supplier:
                                                        {{ \App\Models\Suppliers::where('id', $stockP->supplier_id)->first()->supplier_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-8">Retail Price</div>
                                                    <div class="col-md-4"><span class="text-primary">₱{{ number_format($stockP->price, 2) }}</span></div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-8">Supplier Price</div>
                                                    <div class="col-md-4"><span
                                                            class="text-primary">₱{{ number_format($stockP->supplier_price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                            $availableStock = $stockP->stock - $stockP->subtracted_stock;
                                                        @endphp
                                                        <span class="badge badge-sm fw-bold rounded-pill
                                                            {{ $availableStock > 0 ? 'bg-primary-soft text-primary' : 'bg-danger-soft text-danger' }}">
                                                            {{ $availableStock > 0 ? $availableStock . ' Stocks Available' : 'No Stocks' }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12 mt-2">Date Added:
                                                        {{ $stockP->created_at->format('F d Y') }}</div>
                                                    <div class="col-md-12 mt-2">
                                                        Expiry:
                                                        {{ $stockP->expiry_date ? \Carbon\Carbon::parse($stockP->expiry_date)->format('F d Y') : 'No Expiry' }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-datatable btn-outline-primary me-2 edit-stock-btn" data-id="{{ $product->id }}" data-stockid="{{ $stockP->id }}"><i
                                                            class="fa-regular fa-pen-to-square"></i></button>
                                                    <button class="btn btn-datatable btn-outline-primary me-2 delete-stock-btn" data-id="{{ $product->id }}" data-stockid="{{ $stockP->id }}"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                    <button class="btn btn-datatable btn-outline-primary me-2 repack-stock-btn" data-id="{{ $product->id }}" data-stockid="{{ $stockP->id }}"><i
                                                            class="fa-solid fa-box-open"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>