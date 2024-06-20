<?php

include "../../connect.php";
$email = filterRequest('email');
$verifycode = rand(10000,99999);

$statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_email`= ?");
$statment->execute([$email]);
$count = $statment->rowCount();
if($count>0){
    $data = array(
        "admin_verifycode"=>$verifycode
    );
    updateData("admin",$data,"`admin_email`='$email'");
    sendEmail($email,"Verify Code Ecommerce",$verifycode);
}else{
    printFailure();
}