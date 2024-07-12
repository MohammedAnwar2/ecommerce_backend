<?php
include "../../connect.php";
$id = filterRequest("userId");
getAllData("allFavorite","favorite_usersId = $id AND items_active != 0");
?>