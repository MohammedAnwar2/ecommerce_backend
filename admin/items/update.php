<?php
include "../../connect.php";

$name_en   =  filterRequest("name_en");
$name_ar   =  filterRequest("name_ar");
$desc_en   =  filterRequest("desc_en");
$desc_ar   =  filterRequest("desc_ar");
$count     =  filterRequest("count");
$active    =  filterRequest("active");
$price     =  filterRequest("price");
$discount  =  filterRequest("discount");
$catid     =  filterRequest("catid");
$id        =  filterRequest("id");
$imageold  =  filterRequest("imageold");
$imagename =  imageUpload("../../uploade/item", "files");

$data = array(
    "items_name"     => $name_en,
    "items_name_ar"  => $name_ar,
    "items_desc"     => $desc_en,
    "items_desc_ar"  => $desc_ar,
    "items_count"    => $count,
    "items_active"   => $active,
    "items_price"    => $price,
    "items_discount" => $discount,
    "items_cat"      => $catid,
);

if ($imagename != "empty" && $imagename != "fail") {
    deleteFile("../../uploade/item",$imageold);
    $data["items_image"] = $imagename;
}
// $notifymedate = getAllData("notifyme","notifyme_itemsid = $id",false);
echo $notifymedate;
// if(count($notifymedate)!= 0){
//     foreach($notifymedate as $element){
        
//     }
// }
updateData("items", $data, "items_id = $id");


?>
