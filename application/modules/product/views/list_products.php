<!--@uhter   M.Bahaa-->


<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<h1>Welcome to Products List!</h1>
<div id="containerProductsList">
    <!-- *** Customer Grid Table Start *** -->
    <table id="<?= $productsListGridId; ?>" ></table>
    <div id="<?= $productsListPagerId; ?>"></div>
    <!-- *** Customer Grid Table End *** -->

    <!-- Add new Customer Form Start-->
    <div id="addProductsDiv" >

    </div>

    <?= $productsListGrid; ?>

    <script>
        var productsListGridId = "<?= $productsListGridId ?>";
        function addNewProductFun(rowid) {
            $.ajax({
                type: "POST",
                url: "<?= base_url("/product/addProducts"); ?>",
                success: function (data) {
                    $("#addProductsDiv").html(data);
                    if (rowid != undefined)
                    {
                        var rowData = $("#<?= $productsListGridId; ?>").getRowData(rowid);
                        $('#addProductsForm input[name="productId"]').val(rowData['productId']);
                        $('#addProductsForm input[name="productName"]').val(rowData['productName']);
                        $('#addProductsForm input[name="productPrice"]').val(rowData['productPrice']);
                        $('#addProductsForm textarea[name="productDescription"]').val(rowData['productDescription']);
                        $('#addProductsModalTitle').html('Edit Product');
                        $('#addProductsSave').html('Update');
                    }
                    else
                    {
                        $('#addProductsModalTitle').html('Add New Product');
                        $('#addProductsSave').html('Save');
                    }

                    $('#addProductsModel').modal('show');
                },
                error: function ()
                {
                    showNotification('error', 'application[error]', 'application[error]');
                }
            });
        }
        function  deleteProduct(productId) {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?= base_url("/product/deleteProducts"); ?>",
                data: {
                    productId: productId
                },
                success: function (data) {

                    if (data.failed) {
                        showNotification('error', 'application[error]', 'application[error]');
                    }
                    else if (data.succeed)
                    {
                        $("#<?= $productsListGridId; ?>").trigger("reloadGrid");
                        showNotification('success', 'application', 'application');

                    } else {
                        showNotification('error', 'application[error]', 'application[error]');
                    }
                },
                error: function ()
                {
                    showNotification('error', 'application[error]', 'application[error]');
                }
            });
        }
        function deleteProductFun(rowId) {
            confirmDeleteNotification('deleteProduct', rowId);
        }
    </script>