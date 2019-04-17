<style>
    #editDoctorScheduleModel  input
    {
        border-style: solid;
        border-width: 1px; 
        border-color: black;

    }

</style>


<div class="modal fade col-md-12" id="editDoctorScheduleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="background-color: #FFF;">
        <div class="modal-content" style="">
            <form method="post" action="<?= base_url('/doctor/editDoctorSchedule') ?>" id="editDoctorScheduleForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                    <h3 class="modal-title" id="editDoctorScheduleModalTitle">Edit Doctor Schedule</h3>
                </div>
                <div class="modal-body">
                    <div class="container" style="width: 685px;">
                        <div class="row">
                            <div class=" col-sm-3 ">
                                <label> <h3> Day :-</h3></label>  
                            </div>
                            <div class="col-sm-3">
                                <label> <h3> From </h3></label> 
                            </div>
                            <div class="col-sm-3">
                                <label> <h3> To </h3></label> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Saturday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]" id="saturday_from_txt"/>
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="saturday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="SaturdayError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Sunday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]"  id="sunday_from_txt" />
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="sunday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="sundayError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Monday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]"  id="monday_from_txt" />
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="monday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="mondayError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Tuesday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]"  id="tuesday_from_txt" />
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="tuesday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="tuesdayError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Wednesday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]"  id="wednesday_from_txt" />
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="wednesday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="wednesdayError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Thursday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]"  id="thursday_from_txt" />
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="thursday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="thursdayError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Friday :-</h5></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-3" maxlength="5" name="from[]"  id="friday_from_txt" />
                            </div>
                            <div class="col-sm-3">
                                <input  type="text" class="col-sm-3" maxlength="5" name="to[]"  id="friday_to_txt" />
                            </div>
                            <div class="col-sm-3 " id="fridayError" ></div>
                        </div>

                        <div class="row">
                            <hr style="width:82%;float: left;"/>
                        </div>

                        <div class="row">
                            <label> <h3> Doctor Information</h3></label>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> First Name :-</h5></label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="col-sm-12" maxlength="50" name="firstName"  id="firstName_txt" />
                            </div>
                            <div class="col-sm-3 " id="firstNameError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Middle Name :-</h5></label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="col-sm-12" maxlength="50" name="middleName"  id="middleName_txt" />
                            </div>
                            <div class="col-sm-3 " id="middleNameError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Last Name :-</h5></label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="col-sm-12" maxlength="50" name="lastName"  id="lastName_txt" />
                            </div>
                            <div class="col-sm-3 " id="lastNameError" ></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label> <h5> Specialty :-</h5></label>
                            </div>
                            <div class="col-sm-5">
                                <select class="col-sm-12" id="specialtyType_sel" name="specialtyType">
                                    <option value="0">Select</option>
                                    <?php foreach ($specialtyTypes as $value): ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-3 " id="specialtyError" ></div>
                        </div>



                    </div><!-- /.modal-content -->
                    <input type="text" maxlength="60" name="doctorId" hidden="true" />
                </div><!-- /.modal-dialog -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                    <button type="submit" class="btn btn-primary" id="editDoctorScheduleSave"> Submit </button>
                </div>
            </form>
        </div><!-- /.modal -->
    </div>
    <!-- Add new Customer Form End -->
</div>

<script>
    $('#editDoctorScheduleForm').ajaxForm({
        dataType: 'json',
        success: function (data) {

            if (data.status) {
                $('#editDoctorScheduleModel').modal('hide');
                refreshGrid(doctorScheduleListGridId);
                showNotification('success', 'application', 'application');
            } else {
                showNotification('error', 'application[error]', 'application[error]');
            }
        },
        beforeSubmit: function () {
            if ($('#editDoctorScheduleForm').validationEngine('validate')) {
                return true;
            }

            return false;
        }
    });


</script>