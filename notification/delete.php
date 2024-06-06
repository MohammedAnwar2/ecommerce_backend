<?php
include "../connect.php";
$notificationsid = filterRequest("notificationsid");
deleteData("notifications","notifications_id = $notificationsid");
?>