<?php
include "../../connect.php";

$name          =  filterRequest("name");
$expiredate    =  filterRequest("expiredate");
$discount      =  filterRequest("discount");
$count         =  filterRequest("count");

$data = array(
    "coupon_name"     => $name,
    "coupon_expiredate"  => $expiredate,
    "coupon_discount"     => $discount,
    "coupon_count"  => $count,
);
insertData("coupon", $data);
?>