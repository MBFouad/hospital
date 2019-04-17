<script> 
    var settings = {
        baseUrl: "<?= $this->serverUrl() ?>",
        notificationText:'<?php echo $this->translate('application[are_you_sure_you_want_to_delete?]')?>',
        notificationTitle:'<?php echo $this->translate('application[confirmation_delete]')?>',
        notificationOkButtonText:'<?php echo $this->translate('application[ok]')?>',
        notificationCancelButtonText:'<?php echo $this->translate('application[cancel]')?>'
    };
</script>