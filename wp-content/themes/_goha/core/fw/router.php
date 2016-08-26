<?php

Routes::map('form-order', function($params){
    Routes::load('form_order.php', $params);
});

Routes::map('send-email', function($params){
    Routes::load('email-send.php', $params);
});
