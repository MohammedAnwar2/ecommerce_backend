<?php
include "../../connect.php";
$favoriteId = filterRequest("favoriteId");
deleteData("favorite","favorite_id = $favoriteId");
?>