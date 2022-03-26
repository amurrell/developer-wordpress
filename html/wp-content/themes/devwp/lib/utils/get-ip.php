<?php
function get_ip() {

    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $ip= $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
        $ip= $_SERVER["HTTP_CLIENT_IP"];
    } else if (isset($_SERVER["REMOTE_ADDR"])) {
        $ip= $_SERVER["REMOTE_ADDR"];
    }

    return $ip; 
}
