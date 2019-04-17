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


<div class="modal fade col-md-12" id="getBookingDataModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="background-color: #FFF;">
        <div class="modal-content" style="">
            <form method="post" action="<?= base_url('/doctor/getBookingData') ?>" id="getBookingDataForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                    <h3 class="modal-title" id="getBookingDataModalTitle">Booking Success</h3>
                </div>
                <div class="modal-body">
                    <div class="container" style="width: auto;">
                        <div class="col-md-12 row">
                            <p>Thanks A Lot Dear Patient Your Reservation Is Successfully Done<br/>Your Booking Informatica :-</p>
                            <hr/>
                        </div>

                        <div class="even col-sm-12 row">
                            <div class="col-sm-5">
                                <label> <h5> Patient Name :- </h5></label>
                            </div>
                            <div class="col-sm-7" style="text-align:center;">
                                <h5><label id="getBookingPatientName"></label></h5>
                            </div>
                        </div>
                        <div class="odd col-sm-12 row">
                            <div class="col-sm-5">
                                <label> <h5> Book Date :- </h5></label>
                            </div>
                            <div class="col-sm-7" style="text-align:center;">
                                <h5><label id="getBookingData"></label></h5>
                            </div>
                        </div>
                        <div class="even col-sm-12 row">
                            <div class="col-sm-5">
                                <label> <h5> Doctor Name :- </h5></label>
                            </div>
                            <div class="col-sm-7" style="text-align:center;">
                                <h5><label id="getBookingDoctorName"></label></h5>
                            </div>
                        </div>
                        <div class="odd col-sm-12 row">
                            <div class="col-sm-5" >
                                <label> <h5> Book Number :- </h5></label>
                            </div>
                            <div class="col-sm-7" style="text-align:center;">
                                <h5><label id="getBookingBookingNumber"></label></h5>
                            </div>
                        </div>
                        <div class="even col-sm-12 row">
                            <div class="col-sm-5">
                                <label> <h5> Expected Time :- </h5></label>
                            </div>
                            <div class="col-sm-7" style="text-align:center;">
                                <h5><label id="getBookingExpectedTime"></label></h5>
                            </div>
                        </div>

                    </div><!-- /.modal-content -->
                   
                </div><!-- /.modal-dialog -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                </div>
            </form>
        </div><!-- /.modal -->
    </div>
    <!-- Add new Customer Form End -->
</div>

<script>
</script>