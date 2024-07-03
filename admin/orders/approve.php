<?php 
include "../../connect.php";

$usersid = filterRequest("usersid");
$ordersid = filterRequest("ordersid");

$statment = $con->prepare("UPDATE `orders` SET `orders_status`= 1 WHERE `orders_id` = ? AND `orders_status` = ? ");
$statment->execute([$ordersid, 0]);
$count = $statment->rowCount();
if ($count > 0) {
    $title = "Successfully";
    $pageid="none";
    $userpagename="orderpendingrefresh";
    $adminpagename="adminacceptedrefresh";
    $imageUrl = null;
    insertUsersNotification($title, "The order has been approved", $usersid , "users$usersid" , $pageid,$userpagename ,$imageUrl);
    insertAdminNotification($title, "The order number $ordersid has been approved", "admin" , $pageid,$adminpagename  ,$imageUrl);
    // sendFCMMessage("admin", $title, $body,$pageid,$adminpagename, $imageUrl);
    echo json_encode(["status" => "success"]);
}else{
    echo json_encode(["status" => "failure"]);
}

// orderdeliveryacceptedrefresh
