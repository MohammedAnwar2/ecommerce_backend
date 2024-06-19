<?php
include "../../connect.php";
$delivertid = filterRequest("deliveryid");
getAllData("ordersview","orders_status = 3 AND orders_deliveryid = '$delivertid'",null);
?>