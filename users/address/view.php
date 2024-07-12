<?php
include "../../connect.php";
$usersId = filterRequest("usersId");
getAllData("address","address_usersId = $usersId",null);
?>