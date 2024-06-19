<?php
include "../../../connect.php";
$password = sha1($_POST['password']);
$email = filterRequest('email');

$statment = $con->prepare("SELECT * FROM `dilevery` WHERE `dilevery_email`= ? AND `dilevery_password`= ?");
$statment->execute([$email, $password]);
$count = $statment->rowCount();
$data = array("dilevery_password" => $password);

if ($count > 0) {
    printFailure("Unable to set the same password again");
} else {
    updateData("dilevery", $data, "`dilevery_email`='$email'");
}
// {"":""} = ARRAY(""=>"")