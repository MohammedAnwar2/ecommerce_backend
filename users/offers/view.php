<?php
include "../../connect.php";


$statment = $con->prepare("SELECT itemview.* , 1 AS favorite , ROUND((items_price - (items_price*items_discount/100)),2)AS itemspricediscount from itemview 
JOIN favorite ON favorite.favorite_itemsId = itemview.items_id 
WHERE items_discount != 0 AND items_active != 0
UNION ALL
SELECT itemview.*,0 AS favorite , ROUND((items_price - (items_price*items_discount/100)),2) AS itemspricediscount FROM itemview
WHERE  items_discount != 0 AND items_active != 0 AND items_id NOT IN ( SELECT items_id 
                                              from itemview JOIN favorite 
                                              ON favorite.favorite_itemsId = itemview.items_id)");
$statment->execute();
$count = $statment->rowCount();
$data=$statment->fetchAll(PDO::FETCH_ASSOC);
if($count>0)
{
    printSuccess($data);
}else{
    printFailure();
}
