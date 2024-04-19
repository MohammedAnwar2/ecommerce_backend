<?php
include "../connect.php";
$id = filterRequest("userId");
getAllData("allFavorite","favorite_usersId = $id");
?>