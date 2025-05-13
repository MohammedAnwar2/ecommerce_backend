<?php

include "../../../connect.php";
$dileveryName = filterRequest('dileveryName');
$email = filterRequest('email');
$phone = filterRequest('phone');
$password = sha1($_POST['password']);
$verifycode = rand(10000,99999);

$statment = $con->prepare("SELECT * FROM `dilevery` WHERE `dilevery_phone`= ? OR `dilevery_email`= ?");
$statment->execute([$phone,$email]);
$count = $statment->rowCount();
$data = $statment->fetch(PDO::FETCH_DEFAULT);
if($count>0){
    echo json_encode(array("status"=>false,"message"=>"This email or phone number already exists"));
    printFailure();
}else{
    $data =array(
        "dilevery_name"=>$dileveryName,
        "dilevery_email"=>$email,
        "dilevery_phone"=>$phone,
        "dilevery_password"=>$password,
        "dilevery_verifycode"=>$verifycode
    );
    // sendEmail($email,"Verify Code Ecommerce",$verifycode);
    insertData("dilevery",$data);
}