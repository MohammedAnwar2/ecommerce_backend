<?php
include "../../connect.php";
$addressId = filterRequest("addressId");
$name = filterRequest("name");
$city = filterRequest("city");
$street = filterRequest("street");
$lat = filterRequest("lat");
$long = filterRequest("long");

$data = array(
    "address_id" => $addressId,
    "address_name" => $name,
    "address_city" => $city,
    "address_street" => $street,
    "address_lat" => $lat,
    "address_long" => $long
);
updateData("address", $data,"address_id = $addressId");
?>