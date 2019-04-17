<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1><marquee>Welcome In Shirton H. Web Site</marquee></h1>

<script>
    $(function () {
        $("#tabs").tabs({
        });
    });
</script>
</head>
<body>
    <div id="tabs">
        <ul>
            <li><a href="<?php echo base_url('doctor/listDoctorSchedule'); ?>#tabs-1">Doctor Schedule</a></li>
            <li><a href='<?php echo base_url('specialtylist/listSpecialty'); ?>'>Specialty</a></li>
            <li><a href= '<?php echo base_url('product/listProducts'); ?>'>Products</a></li>
            <?php
            $getUserSession = $this->session->get_userdata();
            if (isset($getUserSession['userType']) && $getUserSession['userType'] == "ADMIN") :
                ?>
                <li><a href= '<?php echo base_url('doctor/bookingDoctorReport'); ?>'>Report</a></li>
            <?php endif; ?>
        </ul>
        <div id="tabs-1">

        </div>
        <div id="tabs-2">
            <p></p>
        </div>
        <div id="tabs-3">

        </div>
        <?php
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userType']) && $getUserSession['userType'] == "ADMIN") :
            ?>
            <div id="tabs-4">

            </div>
        <?php endif; ?>
    </div>