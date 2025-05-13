<?php 
include "../../connect.php";

$usersid = filterRequest("usersid");
$ordersid = filterRequest("ordersid");
$deliveryid = filterRequest("deliveryid");

// $statment = $con->prepare("UPDATE `orders` SET `orders_status`= 3 , `orders_deliveryid`= $deliveryid WHERE `orders_id` = ? AND `orders_status` = ? ");
// $statment->execute([$ordersid, 2]);
$statment = $con->prepare("UPDATE `orders` SET `orders_status`= 3, `orders_deliveryid`= ? WHERE `orders_id` = ? AND `orders_status` = ?");
$statment->execute([$deliveryid, $ordersid, 2]);
$count = $statment->rowCount();
if ($count > 0) {
    $imageUrl = null;
    insertUsersNotification("Successfully", "Your Order On The Way", $usersid , "users$usersid" , "none","orderpendingrefresh" ,$imageUrl);
    sendFCMMessage("dilevery", "Warning", "The Order is recived by the delivery man ".$deliveryid,"none","orderdeliveryacceptedrefresh", $imageUrl);
    insertAdminNotification("Successfully", "The Order number $ordersid is recived by the delivery man ".$deliveryid , "admin" , "none","adminacceptedrefresh",$imageUrl);
    sendFCMMessage("admin", "Warning", "The Order is recived by the delivery man","none","adminacceptedrefresh", $imageUrl);
    echo json_encode(["status" => "success"]);
}else{
    echo json_encode(["status" => "failure"]);
}
