<?php
include "connect.php";
$allData = array();
$allData['status'] = 'success';
$allData['categories'] = getAllData("categories",null,null,false);
if(count($allData['categories'])==0)
{
    $allData['status']="failure";
}else{
    $allData['items'] = getAllData("itemview",null,null,false);
}
echo json_encode($allData);

?>