<?php

include "../../../connect.php";
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
    sendEmail($email,"Verify Code Ecommerce",$verifycode);
}else{
    printFailure();
}