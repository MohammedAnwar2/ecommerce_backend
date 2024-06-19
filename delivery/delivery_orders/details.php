<?php
include "../../connect.php";
$orderid = filterRequest("ordersid");
getAllData("orderdetailsview","cart_orders = '$orderid'");
?>