<?php
include "../connect.php";
$usersId = filterRequest("usersId");
$itemsId = filterRequest("itemsId");
deleteData("cart","cart_usersId = $usersId AND cart_itemsId=$itemsId Limit 1");
?>