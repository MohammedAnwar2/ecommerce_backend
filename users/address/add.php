<?php
include "../../connect.php";
$usersId = filterRequest("usersId");
$name = filterRequest("name");
$city = filterRequest("city");
$street = filterRequest("street");
$lat = filterRequest("lat");
$long = filterRequest("long");

$data = array(
    "address_usersId" => $usersId,
    "address_name" => $name,
    "address_city" => $city,
    "address_street" => $street,
    "address_lat" => $lat,
    "address_long" => $long
);
insertData("address", $data);
?>