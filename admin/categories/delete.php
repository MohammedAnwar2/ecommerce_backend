<?php
include "../../connect.php";
$id = filterRequest("id");
$imageold = filterRequest("imageold");
deleteFile("../../uploade/categories",$imageold);
deleteData("categories","categories_id = $id")

?>