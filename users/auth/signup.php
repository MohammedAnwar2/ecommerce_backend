<?php

include "../../connect.php";
$username = filterRequest('username');
$email = filterRequest('email');
$phone = filterRequest('phone');
$password = sha1($_POST['password']);
$verifycode = rand(10000,99999);


$statment = $con->prepare("SELECT * FROM `users` WHERE `users_phone`= ? OR `users_email`= ?");
$statment->execute([$phone,$email]);
$count = $statment->rowCount();
$data = $statment->fetch(PDO::FETCH_DEFAULT);
if($count>0){
    printFailure();
}else{
    $data =array(
        "users_name"=>$username,
        "users_email"=>$email,
        "users_phone"=>$phone,
        "users_password"=>$password,
        "users_verifycode"=>$verifycode
    );
    sendEmail($email,"Verify Code Ecommerce",$verifycode);
    insertData("users",$data);
}