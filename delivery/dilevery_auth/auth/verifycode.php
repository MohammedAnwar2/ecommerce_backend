<?php
include "../../../connect.php";
$email = filterRequest("email");
$verifycode = filterRequest("verifycode");
$statment = $con->prepare("SELECT * FROM `dilevery` WHERE `dilevery_email` = ? AND `dilevery_verifycode`=? ");
$statment->execute([$email, $verifycode]);
$count = $statment->rowCount();
if ($count > 0) {
    $data = array(
        "dilevery_approve"=>1
    );
    updateData("dilevery",$data,"`dilevery_email`='$email'");
} else {
    printFailure("Verify Code Not Correct");
}
