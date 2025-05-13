<?php

include "../../connect.php";
$username = filterRequest('username');
$email = filterRequest('email');
$phone = filterRequest('phone');
$password = sha1($_POST['password']);
$verifycode = rand(10000,99999);


$statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_phone`= ? OR `admin_email`= ?");
$statment->execute([$phone,$email]);
$count = $statment->rowCount();
$data = $statment->fetch(PDO::FETCH_DEFAULT);
if($count>0){
    printFailure();
}else{
    $data =array(
        "admin_name"=>$username,
        "admin_email"=>$email,
        "admin_phone"=>$phone,
        "admin_password"=>$password,
        "admin_verifycode"=>$verifycode
    );
    insertData("admin",$data);
    // sendEmail($email,"Verify Code Ecommerce",$verifycode);
}