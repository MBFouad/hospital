<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id = "user_login">
    <form id = "user_login_form" action = "<?php echo base_url('/welcome/login'); ?>" method = "post">
        <h3>Login</h3>

        <div class="row">
            <div class="col-md-2">
                <h4> <label for = "username">User Name</label></h4>
            </div>
            <div class="col-md-4">
                <input type = "text" id = "username" name="username" placeholder = "User Name" class="col-md-12 validate[required]" />
            </div>
        </div> 
        <div class="row">
        </div>

        <div class="row" style="padding-top: 10px;">
            <div class="col-md-2">
                <h4>  <label for = "password">Password</label></h4>
            </div>
            <div class="col-md-4">
                <input type = "password" id = "password" name="password" placeholder = "Password" class="col-md-12 validate[required]"/>
            </div>
        </div> <div class="row">
            <div class="col-md-3">
                <button class="button colored"type = "submit"   >Login</button>
            </div>

        </div>

    </form>
</div>
<script>
    $('#user_login_form').ajaxForm({
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                if (data.userType !== "ADMIN")
                {
                    $("#user_signup_li").hide();
                }
                $.ajax({
                    url: "<?= base_url("/welcome/adminstration"); ?>",
                    type: "post",
                    dataType: "html",
                    success: function (data) {
                        $("#contain_div").hide();
                        $("#contain_div3").removeClass("col-md-8");
                        $("#contain_div3").removeClass("col-md-offset-2");
                        $("#contain_div3").addClass("col-md-12");
                        $("#contain_div3").html(data);
                        $("#contain_div2").show();
                        $("#user_login_li").hide();
                        $("#user_logout_li").show();
                    },
                });
            } else if (!data.status) {
                showNotification('error', 'application[error]', 'application[error]');
            }

        },
        beforeSubmit: function () {
            if ($('#user_sign_up_form').validationEngine('validate')) {
                return true;
            } else {
                return false;
            }
        }
    });

</script>
