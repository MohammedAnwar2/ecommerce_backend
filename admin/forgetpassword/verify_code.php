<?php
include "../../connect.php";
$email = filterRequest("email");
$verifycode = filterRequest("verifycode");
$statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_email` = ? AND `admin_verifycode`=?  ");//AND `admin_approve`= 1 
$statment->execute([$email, $verifycode]);
$count = $statment->rowCount();
if ($count > 0) {
    printSuccess();
} else {
    printFailure("Verify Code Not Correct");
}