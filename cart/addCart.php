<?php
include "../connect.php";
$usersId = filterRequest("usersId");
$itemsId = filterRequest("itemsId");
$itemprice = filterRequest("itemprice");

$data = array(
    "cart_usersId" => $usersId,
    "cart_itemsId" => $itemsId,
    "cart_itemprice"=>$itemprice
);
insertData("cart", $data);

// $count = getData("cart", "cart_usersId=$usersId AND cart_itemsId = $itemsId", null, false);
// if ($count > 0) {
//     echo json_encode(array("status" => "there are some items"));
// } else {
// $data = array(
//     "cart_usersId" => $usersId,
//     "cart_itemsId" => $itemsId
// );
// insertData("cart", $data);
// }
