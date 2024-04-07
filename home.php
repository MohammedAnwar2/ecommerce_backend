<?php
include "connect.php";
//if we want to return many list , do like bellow
$allData = array();
$allData['status'] = 'success';
$allData['categories'] = getAllData("categories",null,null,false);
if(count($allData['categories'])==0)
{
    $allData['status']="failure";
}else{
    $allData['items'] = getAllData("itemview","items_discount!=0",null,false);
}
echo json_encode($allData);

?>