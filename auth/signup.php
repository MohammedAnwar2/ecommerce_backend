<?php

include "../connect.php";
$username = filterRequest('username');
$email = filterRequest('email');
$phone = filterRequest('phone');
$password = filterRequest('password');
$verifycode = filterRequest('verifycode');


$statment = $con->prepare("SELECT * FROM `users` WHERE `users_phone`= ? OR `users_email`= ?");
$statment->execute([$password,$email]);
$count = $statment->rowCount();
if($count>0){
    printFailure("email of phone already exists");
}else{
    $data =array(
        "users_name"=>$username,
        "users_email"=>$email,
        "users_phone"=>$phone,
        "users_password"=>$password,
        "users_verifycode"=>$verifycode
    );
    insertData("users",$data);
}