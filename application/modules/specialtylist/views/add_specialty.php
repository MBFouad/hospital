<div class="modal fade" id="addSpecialtyModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('/specialtylist/saveSpecialty') ?>" id="addSpecialtyForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                    <h3 class="modal-title" id="addSpecialtyModalTitle"></h3>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-2">
                                <label> <h5> Specialty Name :- </h5></label>  
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="validate[required] highlight" maxlength="60" name="specialtyName"  />
                            </div>
                            <div class="col-md-3 " id="specialtyNameError" style="color:red"></div>
                        </div>

                    </div><!-- /.modal-content -->
                    <input type="text" maxlength="60" name="specialtyId" hidden="true" />
                </div><!-- /.modal-dialog -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                    <button type="submit" class="btn btn-primary" id="addSpecialtySave"></button>
                </div>
            </form>
        </div><!-- /.modal -->
    </div>
    <!-- Add new Customer Form End -->
</div>

<script>
    $('#addSpecialtyForm').ajaxForm({
        dataType: 'json',
        success: function (data) {

            if (data.status) {
                $('#addSpecialtyModel').modal('hide');
                refreshGrid(specialtyListGridId);
                showNotification('success', 'Update Success', 'Specialty Saved Success');
            } else {
                showNotification('error', 'Update Failed', 'Specialty Unsaved');
            }
        },
        beforeSubmit: function () {
            if ($('#addSpecialtyForm').validationEngine('validate')) {
                return true;
            }

            return false;
        }
    });

</script>