<?php
include "../connect.php";
$itemName = filterRequest('itemName');
getAllData("itemview","(items_name LIKE '%$itemName%' OR items_name_ar LIKE '%$itemName%')AND items_active != 0",null);
?>