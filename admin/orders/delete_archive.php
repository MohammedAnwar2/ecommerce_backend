<?php
include "../../connect.php";
$ordersid = filterRequest("id");
deleteData("orders","orders_id = $ordersid");
?>
