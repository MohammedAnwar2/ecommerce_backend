<?php
include "../../connect.php";
$usersid = filterRequest("usersid");
getAllData("notifications","notifications_usersid = ?",[$usersid],true);
?>