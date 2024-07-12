<?php
include "../../connect.php";
$usersId = filterRequest("usersId");
$itemsId = filterRequest("itemsId");
deleteData("cart","cart_usersId = $usersId AND cart_itemsId=$itemsId AND cart_orders = 0 Limit 1");
?>