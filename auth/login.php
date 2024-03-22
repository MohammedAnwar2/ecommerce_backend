<?php

include "../connect.php";

$password = sha1($_POST['password']);
$email = filterRequest('email');

$statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_password` = ? `users_approve`=1");
$statment->execute([$email,$password]);
$count = $statment->rowCount();
if($count>0){
    echo json_encode(["status"=>"success"]);
}else{
    printFailure("Email OR Phone Not Exists");
}