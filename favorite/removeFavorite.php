<?php
include "../connect.php";
$usersId = filterRequest("usersId");
$itemsId = filterRequest("itemsId");
deleteData("favorite","favorite_usersId = $usersId AND favorite_itemsId=$itemsId");
?>