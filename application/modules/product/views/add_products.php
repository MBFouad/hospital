<div class="modal fade" id="addProductsModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('/product/saveProducts') ?>" id="addProductsForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                    <h3 class="modal-title" id="addProductsModalTitle"></h3>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-2">
                                <label> <h5> Product Name :- </h5></label>  
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="validate[required] highlight" maxlength="60" name="productName"  />
                            </div>
                            <div class="col-md-3 " id="productNameError" style="color:red"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label> <h5> Product Price :-</h5></label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="validate[required] highlight" maxlength="60" name="productPrice" />
                            </div>
                            <div class="col-md-3 " id="productPriceError" style="color:red"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label> <h5> Product Description :-</h5></label>
                            </div>
                            <div class="col-md-2">
                                <textarea class="form-control" rows="3" name="productDescription" ></textarea>
                            </div>
                            <div class="col-md-7 " id="productDescriptionError" style="color:red"></div>
                        </div><br/>
                    </div><!-- /.modal-content -->
                    <input type="text" maxlength="60" name="productId" hidden="true" />
                </div><!-- /.modal-dialog -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                    <button type="submit" class="btn btn-primary" id="addProductsSave"></button>
                </div>
            </form>
        </div><!-- /.modal -->
    </div>
    <!-- Add new Customer Form End -->
</div>

<script>
    $('#addProductsForm').ajaxForm({
        dataType: 'json',
        success: function (data) {

            if (data.status) {
                $('#addProductsModel').modal('hide');
                refreshGrid(productsListGridId);
                showNotification('success', 'Update Success', 'Product Saved Success');
            } else {
                showNotification('error', 'Update Failed', 'Product Unsaved');
            }
        },
        beforeSubmit: function () {
            if ($('#addProductsForm').validationEngine('validate')) {
                return true;
            }

            return false;
        }
    });

</script>