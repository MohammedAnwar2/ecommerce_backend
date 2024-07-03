<?php
include "../../connect.php";

$name_en    = filterRequest("name_en");
$name_ar    = filterRequest("name_ar");
$desc_en    = filterRequest("desc_en");
$desc_ar    = filterRequest("desc_ar");
$count      = filterRequest("count");
$price      = filterRequest("price");
$discount   = filterRequest("discount");
$datenow    = filterRequest("datenow");
$catid      = filterRequest("catid");
$imagename  = imageUpload("../../uploade/item", "files");

$data = array(
    "items_name"     => $name_en,
    "items_name_ar"  => $name_ar,
    "items_desc"     => $desc_en,
    "items_desc_ar"  => $desc_ar,
    "items_count"    => $count,
    "items_active"   => "1",
    "items_price"    => $price,
    "items_discount" => $discount,
    "items_date"     => $datenow,
    "items_cat"      => $catid,
);

if ($imagename == "empty" || $imagename == "fail") {
    echo json_encode(array("status" => "failure"));
} else {
    $data["items_image"] = $imagename;
    insertData("items", $data);
}

?>
