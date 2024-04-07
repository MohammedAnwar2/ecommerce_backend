<?php
include "connect.php";
//if we want to return only one list , do like bellow
$categoryId = filterRequest('categoryId');
getAllData("itemview","categories_id = ?",[$categoryId]);

 ?>