<?php
include "connect.php";
//if we want to return many list , do like bellow
$allData = array();
$allData['status'] = 'success';
$allData['categories'] = getAllData("categories",null,null,false);
$allData['strings'] = getAllData("strings",null,null,false);
if(count($allData['categories'])==0)
{
    $allData['status']="failure";
}else{
    $allData['items'] = getAllData("itemstopselling","1=1 order by top_selling DESC",null,false);//change itemview to itemstopselling
}
echo json_encode($allData);

?>