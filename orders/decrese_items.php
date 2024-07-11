<?php
include "../connect.php";
$id = filterRequest("id");
$itemscount = filterRequest("currentitemscount");

$state = $con->prepare("UPDATE `items` SET `items_count`= `items_count`-'$itemscount' WHERE `items_id`='$id'");
$state->execute();
$count = $state->rowCount();
if($count> 0){
    echo json_encode(["status" => "success",]);
}else{
    echo json_encode(["status" => "failure",]);
}
?>