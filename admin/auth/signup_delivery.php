<?php

include "../../connect.php";
$username = filterRequest('username');
$email = filterRequest('email');
$phone = filterRequest('phone');
$password = sha1($_POST['password']);
$verifycode = rand(10000,99999);


$statment = $con->prepare("SELECT * FROM `dilevery` WHERE `dilevery_phone`= ? OR `dilevery_email`= ?");
$statment->execute([$phone,$email]);
$count = $statment->rowCount();
$data = $statment->fetch(PDO::FETCH_DEFAULT);
if($count>0){
    printFailure();
}else{
    $data = array(
        "dilevery_name"=>$username,
        "dilevery_email"=>$email,
        "dilevery_phone"=>$phone,
        "dilevery_password"=>$password,
        "dilevery_verifycode"=>$verifycode
    );
    insertData("dilevery",$data);
    // sendEmail($email,"Verify Code Ecommerce",$verifycode);
}