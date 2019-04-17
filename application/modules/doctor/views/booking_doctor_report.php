
<form method="post" action="<?= base_url('/doctor/getBookingDoctorReport') ?>" id="bookingDoctorReportForm">
    <div class="">
        <h3 class="" id="bookingDoctorReportModalTitle">Booking Doctor Schedule Report</h3>
    </div>
    <div class="" style="width: auto;">
        <div class="row">
            <div class="col-sm-6">
                <div class=" col-sm-5 ">
                    <label> <h3> Doctor Name </h3></label>  
                </div>
                <div class="col-sm-7">
                    <select id ='bookingDoctorReport_doctorName_sel' class="col-sm-12" name="doctorId">
                        <option value="0">Select</option>
                        <?php foreach ($doctors as $value) : ?>
                            <option value="<?= $value['doctorId'] ?>"><?= $value['doctorName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class=" col-sm-5 ">
                    <label> <h3> Doctor Name </h3></label>  
                </div>
                <div class="col-sm-7">
                    <input type="text" class="datepicker col-sm-10" name="date_of_booking" />
                </div>
            </div>


        </div>
    </div><!-- /.modal-content -->

    <div class="row">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
<div id ="report_div" class="col-sm-10">
</div>
<script>
    $("#bookingDoctorReportForm input.datepicker").datepicker({
        showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImageOnly: true,
        buttonImage: "<?= base_url('/assest/img/calendar.png') ?>",
        changeMonth: true,
        changeYear: true,
        yearRange: '2015:2999' //second param is current year as 4 digits
    });
    var closestTab = $("#report_div").closest(".ui-tabs-panel");
    closestTab = $(closestTab).attr('id');
    var uiIdHeight = $("#"+closestTab).height();
    $('#bookingDoctorReportForm').ajaxForm({
        type: "post",
        dataType: 'html',
        success: function (data) {
            $("#report_div").html(data);
            $("#" + closestTab).height(uiIdHeight + $("#report_div").height());
        }
    });

</script>