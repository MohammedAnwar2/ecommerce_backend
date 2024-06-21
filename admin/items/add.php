<?php
include "../../connect.php";

$itemsname_en    = filterRequest("itemsname_en");
$itemsname_ar    = filterRequest("itemsname_ar");
$itemsdesc_en    = filterRequest("itemsdesc_en");
$itemsdesc_ar    = filterRequest("itemsdesc_ar");
$itemscount      = filterRequest("itemscount");
$itemsactive     = filterRequest("itemsactive");
$itemsprice      = filterRequest("itemsprice");
$itemsdiscount   = filterRequest("itemsdiscount");
$itemscatid      = filterRequest("itemscatid");
$imagename       = imageUpload("../../uploade/item", "files");

$data = array(
    "items_name"     => $itemsname_en,
    "items_name_ar"  => $itemsname_ar,
    "items_desc"     => $itemsdesc_en,
    "items_desc_ar"  => $itemsdesc_ar,
    "items_count"    => $itemscount,
    "items_active"   => $itemsactive,
    "items_price"    => $itemsprice,
    "items_discount" => $itemsdiscount,
    "items_cat"      => $itemscatid,
);

if ($imagename == "empty" || $imagename == "fail") {
    echo json_encode(array("status" => "failure"));
} else {
    $data["items_image"] = $imagename;
    insertData("items", $data);
}

?>
