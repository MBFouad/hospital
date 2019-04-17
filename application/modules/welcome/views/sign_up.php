<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style>
    div .row{
        padding: 2px 2px 2px 2px;
    }
</style>

<div id = "user_sign_up_div">
    <form id = "user_sign_up_form" action = "<?php echo base_url('/welcome/createUser'); ?>" method = "post">

        <div class="row">
            <h2>Sign Up</h2>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "first_name">First Name</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12 highlight validate[required]"  type = "text" id = "first_name" name="firstName" placeholder = "First Name" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "last_name">Last Name</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12 highlight validate[required]"  type = "text" id = "last_name" name="lastName" placeholder = "Last Name" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "middle_name">Middle Name</label>
            </div>
            <div class="col-md-4">
                <input  class="col-md-12 highlight validate[required]" type = "text" id = "middle_name" name="middleName" placeholder = "Middle Name" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "username">User Name</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12 highlight validate[required]" type = "text" id = "username" name="username" placeholder = "User Name"/>
            </div>
            <div>
                <label id="username_lab"style="color:red"></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "password">Password</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12 highlight validate[required]"  type = "password" id = "password" name="password" placeholder = "Password" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "email">E-Mail</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12 highlight validate[required]" type = "text" id = "email" name="email" placeholder = "E-Mail" />
            </div>
            <div class="col-md-4">
                <label id="email_lab"style="color:red"></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "gender">Gender</label>
            </div>
            <div class="col-md-4">
                <select class="col-md-12"  id="gender" name="gender">
                    <option> Select </option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>

                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "phone_number">Phone Number</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12 highlight validate[required]"  type = "text" id = "phone_number" name="phoneNumber" placeholder = "Phone Number" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "street">Street</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12"  type = "text" id = "street" name="street" placeholder = "Street" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "city">City</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12" type = "text" id = "city" name="city" placeholder = "City" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "zip_code">Zip Code</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12" type = "text" id = "zip_code" name="zipCode" placeholder = "Zip Code" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "country">Country</label>
            </div>
            <div class="col-md-4">
                <input class="col-md-12" type = "text" id = "country" name="country" placeholder = "Country" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for = "other_details">Country</label>
            </div>
            <div class="col-md-4">
                <textarea class="col-md-12" id = "other_details" name="otherDetails">
                </textarea>
            </div>
        </div>
        <div class="row">
            <button class="button colored" type="submit">Submit</button>
        </div>
    </form>
</div>
<script>
//    $("#user_sign_up_form #gender").combobox({
//        width: "200",
//        height: "50"
//    });
    $('#user_sign_up_form').ajaxForm({
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                showNotification('success', 'application', 'application');
                window.location = "<?php echo base_url();?>";
            } else if (!data.status) {
                if (data.dublication == "E-mail")
                {
                    $("#email_lab").text("* This E-mail Used Before")
                }
                if (data.dublication == "User Name")
                {
                    $("#username_lab").text("* This User Name Used Before")
                }

                showNotification('error', 'application[error]', 'application[error]');
            }
            else
            {
                showNotification('error', 'application[error]', 'application[error]');
            }
        },
        beforeSubmit: function () {
            $("#username_lab").text("");
            $("#email_lab").text("");
            if ($('#user_sign_up_form').validationEngine('validate')) {
                return true;
            } else {
                return false;
            }
        }
    });


</script>