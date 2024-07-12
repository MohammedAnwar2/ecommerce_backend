<?php
include "../../connect.php";
$itemsid =filterRequest("itemsid"); 
$usersid =filterRequest("usersid"); 
$updatedata = array(
    "items_isnotify"=>1
);
$insertdata= array(
    "notifyme_usersid"=>$usersid,
    "notifyme_itemsid"=>$itemsid 
);
$count = updateData("items",$updatedata,"items_id = $itemsid AND items_count = 0",false);
if($count>0){
    insertData("notifyme",$insertdata);
}else{
    echo json_encode(["status" => "failure"]);
}
?>