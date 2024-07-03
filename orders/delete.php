<?php
include "../connect.php";
$ordersid = filterRequest("ordersid");
deleteData("orders","orders_id = $ordersid AND orders_status = 0");
//* send notification to the admin
sendFCMMessage("admin", "Warning", "The User Canceled Order ( Order No $ordersid )","","refershadminpendingorders", null);

?>