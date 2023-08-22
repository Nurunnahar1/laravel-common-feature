 <!-- Modal -->
 <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
<input type="hidden" id="update_id">
    <form action="" method="post" id="updateProductForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update product</h5>

                </div>
                <div class="modal-body">
                   <div class="errorMsgContainer">

                   </div>

                    <div class="form-group">
                        <label for="update_name">Product Name</label>
                        <input type="text" name="update_name" id="update_name" class="form-control"
                            placeholder="Product name">
                    </div>
                    <div class="form-group mt-4">
                        <label for="update_price">Product price</label>
                        <input type="text" name="update_price" id="update_price" class="form-control"
                            placeholder="Product price">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_product">Update Product</button>
                </div>
            </div>
        </div>
    </form>
</div>
