<?php
include "../../connect.php";
$id = filterRequest("id");
deleteData("coupon","coupon_id  = $id");
?>