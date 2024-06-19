<?php 
include "../../connect.php";

$usersid = filterRequest("usersid");
$ordersid = filterRequest("ordersid");

$statment = $con->prepare("UPDATE `orders` SET `orders_status`= 1 WHERE `orders_id` = ? AND `orders_status` = ? ");
$statment->execute([$ordersid, 0]);
$count = $statment->rowCount();
if ($count > 0) {
    $title = "Successfully";
    $body = "The order has been approved";
    $pageid="none";
    $pagename="orderpendingrefresh";
    $imageUrl = null;
    insertNotification($title, $body, $usersid , "users$usersid" , $pageid,$pagename ,$imageUrl);
    echo json_encode(["status" => "success"]);
}else{
    echo json_encode(["status" => "failure"]);
}


