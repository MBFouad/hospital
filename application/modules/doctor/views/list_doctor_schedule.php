<!--@uhter   M.Bahaa-->


<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<h1>Doctors Schedule List!</h1>
<div id="containerProductsList">
    <!-- *** Customer Grid Table Start *** -->
    <table id="<?= $doctorScheduleListGridId; ?>" ></table>
    <div id="<?= $doctorScheduleListPagerId; ?>"></div>
    <!-- *** Customer Grid Table End *** -->

    <!-- Add new Customer Form Start-->
    <div id="editDoctorScheduleDiv" >

    </div>
    <?= $doctorScheduleListGrid; ?>

    <script>
        var doctorScheduleListGridId = "<?= $doctorScheduleListGridId ?>";
        function editDoctorScheduleFun(rowid) {
            $.ajax({
                url: "<?= base_url("/doctor/editDoctorSchedule"); ?>",
                type: "POST",
                dataType: "html",
                sync: false,
                success: function (data) {
                    $("#editDoctorScheduleDiv").html(data);
                    var rowData = $("#<?= $doctorScheduleListGridId; ?>").getRowData(rowid);
                    $('#editDoctorScheduleForm input[name="doctorId"]').val(rowData['doctorId']);
                    middleName_txt
                    $.ajax({
                        url: "<?= base_url("/doctor/getDoctorInfo"); ?>",
                        data: {doctorId: rowData['doctorId']},
                        type: "POST",
                        dataType: "json",
                        sync: false,
                        success: function (data) {
                            if (data.status) {
                                $("#middleName_txt").val(data.middleName);
                                $("#firstName_txt").val(data.firstName);
                                $("#lastName_txt").val(data.lastName);
                                $("#specialtyType_sel").val(data.specialty);
                            }
                        }
                    });
                    for (var key in rowData) {
                        var dayValue = rowData[key].split(":");
                        if (!dayValue[0] || dayValue[0] == undefined)
                            $("#" + key + "_from_txt").val("");
                        else
                            $("#" + key + "_from_txt").val("" + dayValue[0]);
                        if (!dayValue[1] || dayValue[1] == undefined)
                            $("#" + key + "_to_txt").val("");
                        else
                            $("#" + key + "_to_txt").val("" + dayValue[1]);
                    }
                    $('#editDoctorScheduleModel').modal('show');
                },
                error: function ()
                {
                    showNotification('error', 'application[error]', 'application[error]');
                }
            });
        }
        function bookingDoctorScheduleFun(rowid)
        {
            var rowData = $("#<?= $doctorScheduleListGridId; ?>").getRowData(rowid);
            $.ajax({
                url: "<?= base_url("/doctor/bookingDoctorSchedule"); ?>",
                type: "POST",
                dataType: "html",
                data: {doctorId: rowData['doctorId']},
                sync: false,
                success: function (data) {
                    $("#editDoctorScheduleDiv").html(data);
                    $("#bookingDoctorScheduleModel").modal('show');
                }
            });
        }
    </script>