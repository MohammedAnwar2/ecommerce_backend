<?php
include "../../connect.php";
$id = filterRequest("id");
$imageold = filterRequest("imageold");
deleteFile("../../uploade/item",$imageold);
deleteData("items","items_id = $id")

?>