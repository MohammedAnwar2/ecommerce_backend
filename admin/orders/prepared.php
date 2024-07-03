<?php 
include "../../connect.php";

$usersid = filterRequest("usersid");
$ordersid = filterRequest("ordersid");
$type = filterRequest("ordertype");
 
$ordersStatus;
if($type=="0"){
    $ordersStatus = 2;
}else{
    $ordersStatus = 4;
    $imageUrl = null;
    sendFCMMessage("users$usersid", "Successfully", "Thank you to choose our store","none","orderpendingrefresh", $imageUrl);
}
$statment = $con->prepare("UPDATE `orders` SET `orders_status`= '$ordersStatus' WHERE `orders_id` = ? AND `orders_status` = ? ");
$statment->execute([$ordersid, 1]);
$count = $statment->rowCount();
if ($count > 0) {
    $imageUrl = null;
    if($ordersStatus==2){
        insertUsersNotification("Successfully", "The order has been approved", $usersid , "users$usersid" , "none","orderpendingrefresh" ,$imageUrl);
    }
    if($type=="0"){
        sendFCMMessage("dilevery", "Warning", "There is a order waiting to approve","none","orderdeliverypendingrefresh", $imageUrl);
    }
    echo json_encode(["status" => "success"]);
}else{
    echo json_encode(["status" => "failure"]);
}


