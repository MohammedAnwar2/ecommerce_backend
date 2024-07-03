<?php
include "../connect.php";
//if we want to return only one list , do like bellow
$categoryId = filterRequest('categoryId');
$userId = filterRequest('userId');
// getAllData("itemview","categories_id = ?",[$categoryId]);


$statment = $con->prepare("SELECT itemview.* , 1 AS favorite , ROUND((items_price - (items_price*items_discount/100)),2)AS itemspricediscount from itemview 
JOIN favorite ON favorite.favorite_itemsId = itemview.items_id AND favorite.favorite_usersId = $userId
WHERE categories_id = $categoryId AND items_active != 0
UNION ALL
SELECT itemview.*,0 AS favorite , ROUND((items_price - (items_price*items_discount/100)),2) AS itemspricediscount FROM itemview
WHERE  categories_id = $categoryId AND items_active != 0 AND items_id NOT IN ( SELECT items_id 
                                              from itemview JOIN favorite 
                                              ON favorite.favorite_itemsId = itemview.items_id
                                              AND favorite.favorite_usersId = $userId)");
$statment->execute();
$count = $statment->rowCount();
$data=$statment->fetchAll(PDO::FETCH_ASSOC);
if($count>0)
{
    printSuccess($data);
}else{
    printFailure();
}
