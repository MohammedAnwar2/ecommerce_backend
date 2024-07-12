<?php
include "../../connect.php";
$itemName = filterRequest('itemName');
getAllData("itemview","items_discount != 0 AND items_active != 0 AND (items_name LIKE '%$itemName%' OR items_name_ar LIKE '%$itemName%')",null,true);
?>