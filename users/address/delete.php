<?php
include "../../connect.php";
$addressId = filterRequest("addressId");
deleteData("address","address_id = $addressId");
?>