<?php 
include "../../connect.php";

$usersid = filterRequest("usersid");
$ordersid = filterRequest("ordersid");

$data = array(
    "orders_status"=> 1
);

$statment = $con->prepare("UPDATE `orders` SET `orders_status`= 1 WHERE `orders_id` = ? AND `orders_status` = ? ");
$statment->execute([$ordersid, 0]);
$count = $statment->rowCount();
if ($count > 0) {
    $title = "Accept Your Order Successfully";
    $body = "Your order is being prepared, wait for it to arrive";
    $pageid="";
    $pagename="";
    $imageUrl = null;
    sendFCMMessage("users$usersid", $title, $body,$pageid,$pagename, $imageUrl);
    echo json_encode(["status" => "success"]);
}else{
    echo json_encode(["status" => "failure"]);
}


