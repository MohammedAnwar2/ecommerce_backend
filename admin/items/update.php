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
    deleteFile("../../uploade/item", $imageold);
    $data["items_image"] = $imagename;
}
$countData = updateData("items", $data, "items_id = $id", false);
if ($countData > 0) {
    //* to send notification to the user that need this item when this item avaliable => {$count !=0}
    $notifymedate = getAllData("notifyme", "notifyme_itemsid = ?", [$id], false);
    if (count($notifymedate) != 0 && $count != 0) {
        foreach ($notifymedate as $element) {
            $userid = $element["notifyme_usersid"];
            insertUsersNotification("warning", "The $name_en are avaliable at this time ", $userid, "users$userid", "", "notifyme", null);
        }
        //* delete all the users from "notifyme" table they wanted to notify them when the item avaliable , after sending notification to make attention , and the admin add new count of this item 
        // deleteData("notifyme", "notifyme_itemsid = $id", false);
        // $data = array(
        //     "items_isnotify" => 0,
        //     "items_active"   => $active,
        // );
        // //* update the "isnotify" to 0 in "items" table
        // updateData("items", $data, "items_id = $id", false);
    }
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}
