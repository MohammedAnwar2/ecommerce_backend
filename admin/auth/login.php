<?php

include "../../connect.php";

$password = sha1($_POST['password']);
$email = filterRequest('email');

$statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_email` = ? AND `admin_password` = ?");
$statment->execute([$email, $password]);
$count = $statment->rowCount();
$data=$statment->fetch(PDO::FETCH_ASSOC);

if ($count > 0) {
    //when the user login , we should return data becouse we will store them in sharedPrefrences 
    printSuccess($data);
} else {
    $statment = $con->prepare("SELECT * FROM `admin` WHERE `admin_email` = ?");
    $statment->execute([$email]);
    $count = $statment->rowCount();
    if ($count > 0) {
        printFailure("password");
        // printFailure("The password you entered is incorrect. Please try again"); // using 'password' this message will appear in ui
    } else {
        printFailure("email");
        // printFailure("Email not found. Check spelling or sign up!");//using 'eamil'  this message will appear in ui
    }
}
