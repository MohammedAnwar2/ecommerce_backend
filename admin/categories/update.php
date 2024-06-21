<?php
include "../../connect.php";
$categoryname_en = filterRequest("categoryname_en");
$categoryname_ar = filterRequest("categoryname_ar");
$imageold = filterRequest("imageold");
$id = filterRequest("id");
$imagename = imageUpload("../../uploade/categories","files");
if($imagename =="empty" || $imagename =="fail"){
    $data = array(
        "categories_name"=>$categoryname_en,
        "categories_name_ar"=>$categoryname_ar,
    );
}else{
    deleteFile("../../uploade/categories",$imageold);
    $data = array(
        "categories_name"=>$categoryname_en,
        "categories_name_ar"=>$categoryname_ar,
        "categories_image"=>$imagename,
    );
}
updateData("categories",$data,"categories_id = $id");


?>