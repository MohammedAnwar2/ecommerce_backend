<?php
include "../connect.php";
$itemName = filterRequest('itemName');
getAllData("favoriteSearch","items_name LIKE '%$itemName%' OR items_name_ar LIKE '%$itemName%'",null);
?>