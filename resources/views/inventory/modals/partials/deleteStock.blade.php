                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Stock</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the stock of <span
                            class="text-primary">{{ $product->product_name }}</span>?</p>
                </div>
               <div class="modal-footer">
                    <button class="btn btn-primary-soft text-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('stock.delete', ['id' => $product->id, 'stockid' => $stocks->id]) }}" 
                    class="btn btn-danger" type="button">
                        Delete Stock
                    </a>
                </div>