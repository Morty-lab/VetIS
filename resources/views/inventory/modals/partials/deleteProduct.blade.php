                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Product</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span class="text-primary">{{ $product->product_name }}</span>?
                    </p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary-soft text-primary" type="button"
                        data-bs-dismiss="modal">Cancel</button><a href="{{ route('products.delete', $product->id) }}"
                        class="btn btn-danger" type="button">Delete
                        Product</a></div>       