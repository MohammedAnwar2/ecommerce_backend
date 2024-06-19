<?php
include "../../connect.php";
$delivertid = filterRequest("delivertid");
getAllData("ordersview","orders_status = 4 AND orders_deliveryid = '$delivertid' ",null);
?>