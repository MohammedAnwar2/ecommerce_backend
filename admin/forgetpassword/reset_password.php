<?php
include "../../connect.php";
$password = sha1($_POST['password']);
$email = filterRequest('email');

$statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_email`= ? AND `admin_password`= ?");
$statment->execute([$email, $password]);
$count = $statment->rowCount();
$data = array("admin_password" => $password);

if ($count > 0) {
    printFailure("Unable to set the same password again");
} else {
    updateData("admin", $data, "`admin_email`='$email'");
}
// {"":""} = ARRAY(""=>"")