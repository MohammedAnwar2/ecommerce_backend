<?php
include "../../connect.php";
$usersId = filterRequest("usersId");
$itemsId = filterRequest("itemsId");

// $statment = $con->prepare("SELECT * FROM `cart` WHERE cart_usersId=$usersId AND cart_itemsId = $itemsId");
// $statment->execute();
// $data = $statment->fetchAll(PDO::FETCH_ASSOC);
// $count = $statment->rowCount();
// if ($count > 0) {
//     echo json_encode(array("status" => "success", "data" => $data));
// } else {
//     echo json_encode(array("status" => "failure", "data" => 0));
// }
$count = getData("cart", "cart_usersId=$usersId AND cart_itemsId = $itemsId AND cart_orders = 0", null, false);
if ($count > 0) {
    echo json_encode(array("status" => "success", "count" => $count));
} else {
    echo json_encode(array("status" => "failure", "count" => $count));
}
