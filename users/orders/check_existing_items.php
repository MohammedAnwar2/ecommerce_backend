<?php
include "../../connect.php";
$id = filterRequest("id");
$currentitemscount = filterRequest("currentitemscount");

$statment = $con->prepare("SELECT * FROM `items` WHERE `items_id` = ? AND `items_count` >= $currentitemscount");
$statment->execute([$id]);
$count = $statment->rowCount();
if ($count > 0) {
    echo json_encode(["status" => "success",]);
}
else {
    echo json_encode(["status" => "noitems",]);
}
?>