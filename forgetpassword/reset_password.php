<?php
include "../connect.php";
$password = sha1($_POST['password']);
$email = filterRequest('email');

$statment = $con->prepare("SELECT * FROM `users` WHERE `users_email`= ? AND `users_password`= ?");
$statment->execute([$email, $password]);
$count = $statment->rowCount();
$data = array("users_password" => $password);

if ($count > 0) {
    printFailure("Unable to set the same password again");
} else {
    updateData("users", $data, "`users_email`='$email'");
}
// {"":""} = ARRAY(""=>"")