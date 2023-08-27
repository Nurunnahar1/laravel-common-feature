 <!-- Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
     <form action="" method="post" id="addProductForm">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addModalLabel">Add product</h5>

                 </div>
                 <div class="modal-body">
                    <div class="errorMsgContainer">

                    </div>

                     <div class="form-group">
                         <label for="name">Product Name</label>
                         <input type="text" name="name" id="name" class="form-control"
                             placeholder="Product name">
                     </div>
                     <div class="form-group mt-4">
                         <label for="price">Product price</label>
                         <input type="text" name="price" id="price" class="form-control"
                             placeholder="Product price">
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary add_product">Add Product</button>
                 </div>
             </div>
         </div>
     </form>
 </div>
