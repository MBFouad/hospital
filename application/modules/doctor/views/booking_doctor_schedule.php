<style>
    .odd {
        background-color: #F7F7F7;
        color: #666;
        height: 25px;
    }
    .even {
        height: 30px;
    }
</style>


<div class="modal fade col-md-12" id="bookingDoctorScheduleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="background-color: #FFF;">
        <div class="modal-content" style="">
            <form method="post" action="<?= base_url('/doctor/bookingDoctorSchedule') ?>" id="bookingDoctorScheduleForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                    <h3 class="modal-title" id="bookingDoctorScheduleModalTitle">Booking Doctor Schedule</h3>
                </div>
                <div class="modal-body">
                    <div class="container" style="width: auto;">
                        <div class="row">
                            <h5>Note:- Please Double Click On Doctor You Want To Make Booking</h5>
                        </div>
                        <div class="row">
                            <div class=" col-sm-3 ">
                                <label> <h3> Day </h3></label>  
                            </div>
                            <div class="col-sm-3">
                                <label> <h3> date </h3></label> 
                            </div>
                            <div class="col-sm-6">
                                <label> <h3> Number Booking </h3></label> 
                            </div>
                        </div>
                        <?php
                        $i = 0;
                        foreach ($bookingDoctorSchedule as $key => $value):
                            ?>
                            <div id="<?= $key ?>_div" class="col-sm-12 row clickable <?= $col = ($i % 2) ? "even" : "odd"; ?>  col-md-height"
                                 ondblclick=" confirmBooking(this, '<?= $key ?>');
                                             return false;
                                             ">
                                <div class="col-sm-3">
                                    <label> <h5> <?= $value['dateName'] ?></h5></label>
                                </div>
                                <div class="col-sm-3">
                                    <label> <h5><?= $key ?> </h5></label>
                                </div>
                                <div class="col-sm-6" style="text-align:center;">
                                    <label> <h5><?= $value['customerCount'] ?> </h5></label>
                                </div>
                            </div>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </div><!-- /.modal-content -->
                    <input type="text" maxlength="60" name="doctorId" hidden="true" id="bookingDoctorSchedule_doctorId" value="<?= $doctorId ?>"/>
                </div><!-- /.modal-dialog -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                </div>
            </form>
        </div><!-- /.modal -->
    </div>
    <!-- Add new Customer Form End -->
</div>
<div id="getBookingData_div">
</div>

<script>
    function makeBooking(div)
    {
        $.ajax({
            url: "<?= base_url("/doctor/makeBooking"); ?>",
            type: "POST",
            dataType: "json",
            data: {
                doctorId: $("#bookingDoctorSchedule_doctorId").val(),
                bookingDate: $(div).attr('id').replace("_div", "")
            },
            sync: true,
            success: function (data) {
                if (data.status)
                {
                    $('#bookingDoctorScheduleModel').modal('hide');
                    $.ajax({
                        url: "<?= base_url("/doctor/getBookingData"); ?>",
                        type: "POST",
                        dataType: "html",
                        sync: true,
                        success: function (data2) {
                            $("#getBookingData_div").html(data2);

                            $('#getBookingPatientName').html(data.customerName);
                            $('#getBookingData').html(data.DateName + " " + data.Date);
                            $('#getBookingDoctorName').html(data.DoctorName);
                            $('#getBookingBookingNumber').html(data.bookingNumber);
                            $('#getBookingExpectedTime').html(data.expectedTime);
                            $('#getBookingDataModel').modal('show');
                        }
                    });

                    showNotification('success', 'Booking Success', 'Thank You');
                }
                else
                {
                    showNotification('error', 'Booking Failed', 'Login With User Account');
                }
            }
        });
    }
    function confirmBooking(div, date) {
        confirmBookingNotification('makeBooking', div, date);
    }
</script>