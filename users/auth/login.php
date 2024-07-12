<?php

include "../../connect.php";

$password = sha1($_POST['password']);
$email = filterRequest('email');

$statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_password` = ?");
$statment->execute([$email, $password]);
$count = $statment->rowCount();
$data=$statment->fetch(PDO::FETCH_ASSOC);

if ($count > 0) {
    //when the user login , we should return data becouse we will store them in sharedPrefrences 
    printSuccess($data);
} else {
    $statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ?");
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


//----------------------------------------------------------------------------------------------------------

//we can do the below code insteade of the above codes


// $password = sha1($_POST['password']);
// $email = filterRequest('email');

// $statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_password` = ? AND `users_approve`= 1 ");
// $statment->execute([$email, $password]);
// $count = $statment->rowCount()
// if ($count > 0) {
//     echo json_encode(["status" => "success"]);
// } else {
//     printFailure("Email OR Phone Not Exists");
// }

//----------------------------------------------------------------------------------------------------------

// $password = sha1($_POST['password']);
// $email = filterRequest('email');

// $statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_password` = ? AND `users_approve`= 1 ");
// $statment->execute([$email, $password]);
// $count = $statment->rowCount();

// if ($count > 0) {
    //     printSuccess();
    // } else {
        //     $statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ? AND `users_password` = ? ");
        //     $statment->execute([$email, $password]);
        //     $count = $statment->rowCount();
        //     if ($count > 0) {
            //         printFailure("Account not verified yet");
            //     }else{
                //         $statment = $con->prepare("SELECT * FROM `users` WHERE `users_email` = ?");
                //         $statment->execute([$email]);
                //         $count = $statment->rowCount();
                //         if ($count > 0) {
                    //             printFailure("Password Not Valid");
                    //         }else{
//             printFailure("Email Not Valid");
//         }
//     }
// }

//----------------------------------------------------------------------------------------------------------