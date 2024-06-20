<?php
include "../../connect.php";
$email = filterRequest("email");
$verifycode = filterRequest("verifycode");
$statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_email` = ? AND `admin_verifycode`=? ");
$statment->execute([$email, $verifycode]);
$count = $statment->rowCount();
if ($count > 0) {
    $data = array(
        "admin_approve"=>1
    );
    updateData("admin",$data,"`admin_email`='$email'");
} else {
    printFailure("Verify Code Not Correct");
}
