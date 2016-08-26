<?php
global $phpmailer;

add_action( 'phpmailer_init', 'settingSmtp' );
function settingSmtp( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 465;
    $phpmailer->Username = 'thachphathieng@gmail.com';
    $phpmailer->Password = 'kjmyvckdvwulrklv';

    $phpmailer->SMTPSecure = "ssl";
    $phpmailer->From = "thachphathieng@gmail.com";
    $phpmailer->FromName = "Minh";

    // $phpmailer->SMTPDebug = true;
}
