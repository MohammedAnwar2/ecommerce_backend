<?php
include "../../connect.php";
$categoryname_en = filterRequest("categoryname_en");
$categoryname_ar = filterRequest("categoryname_ar");
$imagename = imageUpload("../../uploade/categories","files");
if($imagename =="empty" || $imagename =="fail"){
    $data = array(
        "categories_name"    => $categoryname_en,
        "categories_name_ar" => $categoryname_ar,
    );
    echo json_encode(array("status" => "failure"));
}else{
    $data = array(
        "categories_name"    => $categoryname_en,
        "categories_name_ar" => $categoryname_ar,
        "categories_image"   => $imagename,
    );
    insertData("categories",$data);
}

?>