<?php

include "../../../connect.php";
use Services\Mail\SendMail;

$email = filterRequest('email');
$verifycode = rand(10000,99999);

$statment = $con->prepare("SELECT * FROM `dilevery` WHERE `dilevery_email`= ?");
$statment->execute([$email]);
$count = $statment->rowCount();
if($count>0){
    $data = array(
        "dilevery_verifycode"=>$verifycode
    );
    updateData("dilevery",$data,"`dilevery_email`='$email'");
    SendMail::sendOtpEmail($email, "Verify Code of Ecommerce App", $verifycode);
}else{
    printFailure();
}