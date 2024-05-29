<?php
include "../connect.php";
$couponName = filterRequest("couponName");
$now = date("Y-m-d H:i:s");// CURRENT DATE OF TODAY
getData("coupon","coupon_name = '$couponName' AND coupon_count > 0 AND coupon_expiredate > '$now'");
?>