<?php
include "../connect.php";
$email = filterRequest("email");
$verifycode = filterRequest("verifycode");
$statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_verifycode`=? ");
$statment->execute([$email, $verifycode]);
$count = $statment->rowCount();
if ($count > 0) {
    $data = array(
        "users_approve"=>1
    );
    updateData("users",$data,"`users_email`='$email'");
} else {
    printFailure("verify code not correct");
}
