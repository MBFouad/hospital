<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Grayscale - Start Bootstrap Theme</title>

        <!-- Bootstrap Core CSS -->

        <!-- Custom CSS -->

        <!-- Custom Fonts -->


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <LINK href="<?php echo base_url('/assest/css/style.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/theme/css/form.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/validationEngine/css/validationEngine.jquery.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/bootstrap-multiselect-master/css/bootstrap-multiselect.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/jquery-ui-1.11.0/jquery-ui.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/jquery/css/jquery.searchFilter.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/jqgrid/css/ui.jqgrid.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php // echo base_url('/assest/plugins/jquery-ui-1.11.0/jquery-ui.theme.css');              ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/plugins/pnotify/css/pnotify.custom.min.css'); ?>" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo base_url('/assest/font-awesome/css/font-awesome.min.css" rel="stylesheet'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('/assest/css/jquery-theme/travware/jquery-ui-1.10.0.custom.css" rel="stylesheet'); ?>" rel="stylesheet" type="text/css">
        <LINK href="<?php echo base_url('/assest/css/grayscale.css'); ?>" rel="stylesheet" type="text/css"/>    
        <LINK href="<?php echo base_url('/assest/theme/css/main.css'); ?>" rel="stylesheet" type="text/css"/>    
        <!--<script src="http://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url('/assest/plugins/jquery/js/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jquery/js/jquery.form.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/validationEngine/js/languages/jquery.validationEngine-en.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/validationEngine/js/jquery.validationEngine.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/bootstrap-multiselect-master/js/bootstrap-multiselect.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/pnotify/js/pnotify.custom.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jqgrid/js/i18n/grid.locale-en.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jqgrid/js/jquery.jqGrid.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jqgrid/src/grid.filter.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jqgrid/src/grid.common.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jqgrid/src/grid.formedit.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jqgrid/plugins/jquery.searchFilter.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/plugins/jquery-ui-1.11.0/jquery-ui.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/js/context_menu.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/js/notification.js'); ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('/assest/js/jquery.combobox.js'); ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('/assest/js/multiselectValidation.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assest/js/jquery.easing.min.js'); ?>" type="text/javascript"></script>


    </head>

    <body id="layout_contain_div" data-spy="scroll" data-target=".navbar-fixed-top">

        <!-- Navigation -->
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header" onclick="javascript:homeFun()">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#layout_contain_div">
                        <i class="fa fa-play-circle"></i>  <span class="light">Shirtaon</span> Hospital
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a href="#layout_contain_div"></a>
                        </li>
                        <li>
                            <a  class="page-scroll" href="#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#download">portfolio</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contact</a>
                        </li>
                        <li id="user_signup_li" onclick="javascript:signUpFun();
                                return false;">
                            <a class="page-scroll" href="">Sign up</a>
                        </li>
                        <li id="user_login_li" onclick="javascript:loginFun();
                                return false;">
                            <a href="" class="page-scroll">Login</a>
                        </li>
                        <li onclick="javascript:LogOutFun();
                                return false;"style="display: none" id="user_logout_li" onclick="">
                            <a href="" class="page-scroll">Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div  id="contain_div">
            <!-- Intro Header -->
            <header class="intro">
                <div class="intro-body">
                    <div class="container">
                        <div class="row">
                            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h1>&nbsp;</h1>
                                <a  onclick="javascript:welcomeAdminstration();
                                        return false;" href=""> <h1 class="intro-text" style="color:#EA2E2E;">Shiraton H.</h1></a>
                                <p class="intro-text">Welcome in shiraton hospital website.<br>Get well soon.</p>
                                <a href="#about" class="btn btn-circle page-scroll">
                                    <i class="fa fa-angle-double-down animated"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- About Section -->
            <section id="about" class="container content-section text-center">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h2>About Shiraton Hospital</h2>
                        <p><b>shiraton hospital</b>
                            is a
                            <a title="Health care" href="/wiki/Health_care">health care</a>
                            institution providing
                            <a title="Patient" href="/wiki/Patient">patient</a>
                            treatment with specialized staff and equipment. The best-known type of hospital is the general hospital, which has an
                            <a title="Emergency department" href="/wiki/Emergency_department">emergency department</a>
                            . A district hospital typically is the major health care facility in its region, with large numbers of beds for
                            <a class="mw-redirect" title="Intensive care" href="/wiki/Intensive_care">intensive care</a>
                            and long-term care. Specialised hospitals include
                            <a class="mw-redirect" title="Trauma centre" href="/wiki/Trauma_centre">trauma centres</a>
                            ,
                            <a title="Rehabilitation hospital" href="/wiki/Rehabilitation_hospital">rehabilitation hospitals</a>
                            ,
                            <a title="Children's hospital" href="/wiki/Children%27s_hospital">children's hospitals</a>
                            , seniors' (
                            <a class="mw-redirect" title="Geriatric" href="/wiki/Geriatric">geriatric</a>
                            ) hospitals, and hospitals for dealing with specific medical needs such as
                            <a title="Psychiatry" href="/wiki/Psychiatry">psychiatric</a>
                            problems (see
                            <a title="Psychiatric hospital" href="/wiki/Psychiatric_hospital">psychiatric hospital</a>
                            ) and certain disease categories. Specialised hospitals can help reduce
                            <a class="mw-redirect" title="Health care costs" href="/wiki/Health_care_costs">health care costs</a>
                            compared to general hospitals. A
                            <a title="Teaching hospital" href="/wiki/Teaching_hospital">teaching hospital</a>
                            combines assistance to people with teaching to medical students and nurses. The medical facility smaller than a hospital is generally called a
                            <a title="Clinic" href="/wiki/Clinic">clinic</a>
                            . Hospitals have a range of departments (e.g.,
                            <a title="Surgery" href="/wiki/Surgery">surgery</a>
                            , and
                            <a title="Urgent care" href="/wiki/Urgent_care">urgent care</a>
                            ) and specialist units such as
                            <a title="Cardiology" href="/wiki/Cardiology">cardiology</a>
                            . Some hospitals have
                            <a class="mw-redirect" title="Outpatient" href="/wiki/Outpatient">outpatient departments</a>
                            and some have chronic treatment units. Common support units include a
                            <a title="Hospital pharmacy" href="/wiki/Hospital_pharmacy">pharmacy</a>
                            ,
                            <a title="Pathology" href="/wiki/Pathology">pathology</a>
                            , and
                            <a title="Radiology" href="/wiki/Radiology">radiology</a>
                            .</p>

                    </div>
                </div>
            </section>

            <!-- Download Section -->
            <section id="download" class="content-section text-center">
                <div class="download-section">
                    <div class="container">
                        <div class="col-lg-8 col-lg-offset-2">
                            <h2>Our Portfolio</h2>
                            <p>You can Visit Our Portfolio page From Here.</p>
                            <a href="http://startbootstrap.com/template-overviews/grayscale/" class="btn btn-default btn-lg">Visit Download Page</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="container content-section text-center">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h2>Contact Shiraton Hospital</h2>
                        <p>Feel free to email us to provide some feedback on our Service, give us suggestions for new Services and Products, or to just say hello!</p>
                        <p><a href="mailto:feedback@shiratonh.com">feedback@shiratonhospital.com</a>
                        </p>
                        <ul class="list-inline banner-social-buttons">
                            <li>
                                <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                            </li>
                            <li>
                                <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

        </div>
        <div style="display: none;" id="contain_div2" class="col-md-12">

            <div id="contain_div3" class="col-md-8 col-md-offset-2" style="padding-top: 30px;"> </div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="container text-center">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </footer>



    </body>

</html>
<script>
    function  signUpFun() {
        $.ajax({
            url: "<?= base_url("/welcome/signUp"); ?>",
            type: "post",
            dataType: "html",
            success: function (data) {
                $("#contain_div").hide();
                $("#contain_div3").html(data);
                $("#contain_div2").show();
            },
        });
    }
    function  loginFun() {
        $.ajax({
            url: "<?= base_url("/welcome/login"); ?>",
            type: "post",
            dataType: "html",
            success: function (data) {
                $("#contain_div").hide();
                $("#contain_div3").html(data);
                $("#contain_div2").show();
            },
        });
    }
    function  homeFun() {
        window.location = "<?php echo base_url(); ?>";

    }
    function  LogOutFun() {
        $.ajax({
            url: "<?= base_url("/welcome/logOut"); ?>",
            type: "post",
            dataType: "json",
            success: function () {
                $("#contain_div").show();
                $("#contain_div3").html("");
                $("#contain_div2").hide();
                $("#contain_div3").removeClass("col-md-12");
                $("#contain_div3").addClass("col-md-8");
                $("#contain_div3").addClass("col-md-offset-2");
                $("#user_logout_li").hide();
                $("#user_login_li").show();
                $("#user_signup_li").show();
            },
        });
    }
    function welcomeAdminstration()
    {
        $.ajax({
            url: "<?= base_url("/welcome/adminstration"); ?>",
            type: "post",
            dataType: "html",
            success: function (data) {
                if (data == "false")
                {
                    showNotification('error', 'error', 'Please Login First');
                }
                else
                {
                    $("#contain_div").hide();
                    $("#contain_div3").removeClass("col-md-8");
                    $("#contain_div3").removeClass("col-md-offset-2");
                    $("#contain_div3").addClass("col-md-12");
                    $("#contain_div3").html(data);
                    $("#contain_div2").show();
                    $("#user_login_li").hide();
                    $("#user_logout_li").show();
                }

            },
        });
    }
    $(function () {
        $.ajax({
            url: "<?= base_url("/welcome/checkLogin"); ?>",
            type: "post",
            dataType: "json",
            success: function (data) {
                if (data.status)
                {
                    if (data.userType !== "ADMIN")
                    {
                        $("#user_signup_li").hide();
                    }
                    $("#user_login_li").hide();
                    $("#user_logout_li").show();
                }
            },
        });
    }());
    function refreshGrid(gridId)
    {
        $("#" + gridId).trigger("reloadGrid");
    }

</script>