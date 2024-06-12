<?php
include "../connect.php";
$odersid = filterRequest("odersid");
$ratingValue = filterRequest("ratingValue");
$ratingNote = filterRequest("ratingNote");
$data = array(
    "orders_rating"=>$ratingValue,
    "orders_noteRating"=>$ratingNote
);
updateData("orders",$data,"orders_id = '$odersid' AND orders_rating = 0 AND orders_status = 4");
?>