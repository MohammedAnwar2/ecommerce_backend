<?php
include "../connect.php";
$userid = filterRequest("userid");
$allData = array();
$allData['status'] = 'success';
$allData['itemsidorder'] = getAllData("getitemsidorder","getitemsidorder.cart_usersId = '$userid'",null,false);
$allData['ordersview'] = getAllData("ordersview","orders_userId  = '$userid' AND orders_status != 4",null,false);
if(count($allData['ordersview'])==0)
{
    $allData['status']="failure";
}
echo json_encode($allData);
//getAllData("ordersview","orders_userId  = '$userid' AND orders_status != 4",null);
//* 0- waiting
//* 1- prepare
//* 2- delivery
//* 3- on the way
//* 4- archive
?>
