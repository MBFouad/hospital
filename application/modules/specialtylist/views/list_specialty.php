<!--@uhter   M.Bahaa-->


<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<h1>Specialty List!</h1>
<div id="containerSpecialtyList">
    <!-- *** Customer Grid Table Start *** -->
    <table id="<?= $specialtyListGridId; ?>" ></table>
    <div id="<?= $specialtyListPagerId; ?>"></div>
    <!-- *** Customer Grid Table End *** -->

    <!-- Add new Customer Form Start-->
    <div id="addSpecialtyDiv" >

    </div>

    <?= $specialtyListGrid; ?>

    <script>
        var specialtyListGridId = "<?= $specialtyListGridId ?>";
        function addNewSpecialtyFun(rowid)
        {
            $.ajax({
                type: "POST",
                url: "<?= base_url("/specialtylist/editSpecialty"); ?>",
                success: function (data) {
                    $("#addSpecialtyDiv").html(data);
                    if (rowid != undefined)
                    {
                        var rowData = $("#<?= $specialtyListGridId; ?>").getRowData(rowid);
                        console.log(rowData);
                        $('#addSpecialtyForm input[name="specialtyId"]').val(rowData['specialtyId']);
                        $('#addSpecialtyForm input[name="specialtyName"]').val(rowData['specialtyType']);
                        $('#addSpecialtyModalTitle').html('Edit Specialty');
                        $('#addSpecialtySave').html('Update');
                    }
                    else
                    {
                        $('#addSpecialtyModalTitle').html('Add New Specialty');
                        $('#addSpecialtySave').html('Save');
                    }

                    $('#addSpecialtyModel').modal('show');
                },
                error: function ()
                {
                    showNotification('error', 'application[error]', 'application[error]');
                }
            });
        }
    </script>