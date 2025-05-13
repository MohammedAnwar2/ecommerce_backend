<?php 
include "../../connect.php";

$usersid = filterRequest("usersid");
$ordersid = filterRequest("ordersid");
$deliveryid = filterRequest("deliveryid");

$statment = $con->prepare("UPDATE `orders` SET `orders_status`= 4 WHERE `orders_id` = ? AND `orders_status` = ? ");
$statment->execute([$ordersid, 3]);
$count = $statment->rowCount();
if ($count > 0) {
    $imageUrl = null;
    insertUsersNotification("Successfully", "The Order has been delivered", $usersid , "users$usersid" , "none","orderpendingrefresh" ,$imageUrl);
    insertAdminNotification("Successfully", "The Order number $ordersid has been delivered to the customer", "admin" , "none","adminacceptedandarchivefresh",$imageUrl);
    sendFCMMessage("admin", "Warning", "The Order has been delivered to the customer","none","adminacceptedandarchivefresh", $imageUrl);
    echo json_encode(["status" => "success"]);
}else{
    echo json_encode(["status" => "failure"]);
}
