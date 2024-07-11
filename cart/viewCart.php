<?php
include "../connect.php";
$usersId = filterRequest("usersId");

$data = getAllData("cartProducts", "cart_usersId = ?", [$usersId], false);

$statment = $con->prepare("SELECT SUM(cartProducts.total_price)as totalprice,SUM(cartProducts.currentItemsCount)as totalcount FROM cartProducts
WHERE cart_usersId  = $usersId AND items_active != 0
GROUP BY cart_usersId;");
$statment->execute();
$datacountprice = $statment->fetchAll(PDO::FETCH_ASSOC);
$count = $statment->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success", "datacart" => $data, "countprice" => $datacountprice));
} else {
    echo json_encode(array("status" => "failure", "data" => []));
}

// $usersId = filterRequest("usersId");
// $statment = $con->prepare("SELECT * FROM cartProducts WHERE cart_usersId = $usersId");
// $statment->execute();
// $data = $statment->fetchAll(PDO::FETCH_ASSOC);
// $count = $statment->rowCount();
// if ($count > 0) {
//     echo json_encode(array("status" => "success", "data" => $data));
// } else {
//     echo json_encode(array("status" => "failure", "data" => 0));
// }

// getData("cartProducts",null,null);
