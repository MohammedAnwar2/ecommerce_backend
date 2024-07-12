<?php
include "../../connect.php";
$usersId = filterRequest("usersId");
$itemsId = filterRequest("itemsId");
$data = array(
    "favorite_usersId" => $usersId,
    "favorite_itemsId" => $itemsId
);
insertData("favorite", $data);
?>
