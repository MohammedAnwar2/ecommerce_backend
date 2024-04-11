<!-- <?php
include "connect.php";
$userId = filterRequest('userId');
$itemId = filterRequest('itemId');

$allData['favoriteItem'] = getAllData("favorite", "favorite_usersId = ? AND favorite_itemsId = ?", [$userId, $itemId], false);
if (count($allData['favoriteItem']) == 0) {
    $data = array(
        "favorite_usersId" => $userId,
        "favorite_itemsId" => $itemId
    );
    insertData("favorite", $data);
} else {
    deleteData("favorite", "favorite_usersId = $userId AND favorite_itemsId = $itemId");
} -->


// $allData['favoriteItem'] = getAllData("favoriteItem", "favorite_usersId = ? AND favorite_itemsId = ?", [$userId, $itemId], false);
// if (count($allData['favoriteItem']) == 0) {
//     $data = array(
//         "favorite_usersId" => $userId,
//         "favorite_itemsId" => $itemId
//     );
//     insertData("favorite", $data);
// } else {
//     deleteData("favorite", "favorite_usersId = $userId AND favorite_itemsId = $itemId");
// }