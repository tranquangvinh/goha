jQuery(document).ready(function(){
    jQuery('#acf-field-time_promotion_from').datetimepicker({
        minDate: 0,
        format: "Y/m/d H:i:s"
    });
    jQuery('#acf-field-time_promotion_to').datetimepicker({
        minDate: 0,
        format: "Y/m/d H:i:s"
    });
});
