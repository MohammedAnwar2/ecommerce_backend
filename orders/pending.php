<?php
include "../connect.php";
$userid = filterRequest("userid");
getAllData("orders","orders_userId  = '$userid'",null);
?>