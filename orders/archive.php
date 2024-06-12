<?php
include "../connect.php";
$userid = filterRequest("userid");
getAllData("ordersview","orders_userId  = '$userid' AND orders_status = 4",null);
//* 0- waiting
//* 1- prepare
//* 2- delivery
//* 3- on the way
//* 4- archive
?>