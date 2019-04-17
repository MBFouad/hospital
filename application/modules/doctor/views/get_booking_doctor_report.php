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
<?php if (count($report)): ?>
    <div class="row col-sm-10">
        <div class=" col-sm-6"  style="text-align: center;">
            <h3> Customer Name</h3>
        </div>
        <div class=" col-sm-6"  style="text-align: center;">
            <h3> Number Booking</h3>
        </div>
    </div>
    <?php $i = 0;
    foreach ($report as $value): ?>
        <div class="row col-sm-10 <?= $col = ($i % 2) ? "even" : "odd"; ?>">
            <div class=" col-sm-6" style="text-align: center;">
                <h5><?= $value['customerName'] ?> </h5>
            </div>
            <div class=" col-sm-6"  style="text-align: center;">
                <h5><?= $value['bookingNumber'] ?> </h5>
            </div>
        </div>
        <?php $i++;
    endforeach; ?>
<?php endif; ?>