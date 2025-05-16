<?php
include "../../connect.php";
use Services\Mail\SendMail;

$email = filterRequest('email');
$verifycode = rand(10000,99999);
$statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? ");
$statment->execute([$email]);
$count = $statment->rowCount();
if($count>0){
   // printSuccess();
    // sendEmail($email,"Verify Code Ecommerce",$verifycode);
    SendMail::sendOtpEmail($email, "Verify Code of Ecommerce App", $verifycode);
    $data = array(
        "users_verifycode"=>$verifycode
    );
    updateData("users",$data,"`users_email`='$email'");
}else{
    printFailure("The Email Is Not Register Yet , Please Check Your Email Again");
}