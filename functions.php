<?php

// ==========================================================
//  Copyright Reserved Moahmmed Anwar (Course Ecommerce)
// ==========================================================

//date_default_timezone_set("/");

define("MB", 1048576);

function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    if ($where == null) {
        $stmt = $con->prepare("SELECT * FROM $table");
    } else {
        $stmt = $con->prepare("SELECT * FROM $table WHERE $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();

    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    } else {
        if ($count > 0) {
            return $data;
        } else {
            return  array();
        }
    }
}
function getData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        return $count;
    }
}
function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($dir, $imageRequest)
{
    global $msgError;
    if (isset($_FILES[$imageRequest])) {
        $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
        $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
        $imagesize  = $_FILES[$imageRequest]['size'];
        $allowExt   = array("jpg", "png", "svg", "jpeg");
        // $allowExt   = array("jpg", "png", "gif", "mp3", "pdf","svg");
        $strToArray = explode(".", $imagename);
        $ext        = end($strToArray);
        $ext        = strtolower($ext);

        if (!empty($imagename) && !in_array($ext, $allowExt)) {
            $msgError = "EXT";
        }
        if ($imagesize > 2 * MB) {
            $msgError = "size";
        }
        if (empty($msgError)) {
            move_uploaded_file($imagetmp,  $dir . "/" . $imagename);
            return $imagename;
        } else {
            return $msgError;
        }
    } else {
        return "empty";
    }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
    // End 
}

function printFailure($message = "none")
{
    echo json_encode(["status" => "failure", "message" => $message]);
}
function printSuccess($data = "none")
{
    echo json_encode(["status" => "success", "data" => $data]);
}

//!==============================
//!==============================
// function sendEmail($to,$subject,$body)
// {

//     $message = "To complete the verification process, please use the following verification code: [ $body ]. Your security and privacy are important to us. Best regards";

//     $header = "Dear user";
//     mail($to, $subject, $message, $header);
// }
//!==============================

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\PHPMailer;
// function sendEmail($to, $subject, $body)
// {

//     $mail = new PHPMailer;
//     $mail->isSMTP();
//     $mail->SMTPDebug = 0;
//     $mail->Host = 'smtp.hostinger.com';
//     $mail->Port = 587;
//     $mail->SMTPAuth = true;
//     $mail->Username = 'moan@mohammedanwar.in';
//     $mail->Password = 'Abc#772555127';
//     $mail->setFrom('moan@mohammedanwar.in', 'Mohammed');
//     $mail->addReplyTo('moan@mohammedanwar.in', 'Mohammed');
//     $mail->addAddress($to, 'John');
//     $mail->Subject = $subject;
//     $mail->msgHTML(file_get_contents('message.html'), __DIR__);
//     $mail->Body = $body;
//     //$mail->addAttachment('attachment.txt');
//     if (!$mail->send()) {
//         // echo 'Mailer Error: ' . $mail->ErrorInfo;
//     } else {
//         // echo 'The email message was sent.';
//     }
// }

//!=================================

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';  // Or the includes above

// function sendEmail($to, $subject, $body, $name = 'customer')
// {
//     $mail = new PHPMailer(true);
//     try {
//         // Server settings
//         $mail->isSMTP();
//         $mail->Host       = 'smtp.gmail.com';
//         $mail->SMTPAuth   = true;
//         $mail->Username   = 'moanbm123@gmail.com';         // Your Gmail address
//         $mail->Password   = 'mbtp jzxr yylb pmnq';            // The 16-char App Password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port       = 587;

//         // Recipients
//         $mail->setFrom('moanbm123@gmail.com', $name);
//         $mail->addAddress($to, $name);

//         // Content
//         $mail->isHTML(true);
//         $mail->Subject = $subject;
//         $mail->Body = '
//     <div style="max-width:480px;margin:30px auto;padding:32px 24px;background:#f9fafb;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.07);font-family:sans-serif;">
//         <div style="text-align:center;">
//             <img src="https://cdn-icons-png.flaticon.com/512/2910/2910791.png" alt="OTP" width="60" style="margin-bottom:18px;">
//             <h2 style="color:#2d3748;margin-bottom:8px;">Your Verification Code</h2>
//         </div>
//         <p style="color:#4a5568;font-size:16px;line-height:1.6;margin-bottom:24px;text-align:center;">
//             Please use the following One-Time Password (OTP) to complete your verification process:
//         </p>
//         <div style="text-align:center;margin-bottom:24px;">
//             <span style="display:inline-block;background:#3182ce;color:#fff;font-size:28px;letter-spacing:8px;padding:14px 32px;border-radius:8px;font-weight:bold;">
//                 ' . htmlspecialchars($body) . '
//             </span>
//         </div>
//         <p style="color:#718096;font-size:14px;text-align:center;margin-bottom:0;">
//             This code is valid for 10 minutes. If you did not request this, please ignore this email.
//         </p>
//         <hr style="margin:32px 0 16px 0;border:none;border-top:1px solid #e2e8f0;">
//         <p style="color:#a0aec0;font-size:13px;text-align:center;margin:0;">
//             &copy; ' . date('Y') . ' Your Ecommerce. All rights reserved.
//         </p>
//     </div>';
//         $mail->AltBody = strip_tags($body);

//         $mail->send();
//         echo 'Message sent successfully';
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }



use Google\Auth\Credentials\ServiceAccountCredentials;

require __DIR__ . '/vendor/autoload.php'; // Adjust the path as needed

function sendFCMMessage($topic, $title, $body, $pageid, $pagename, $imageUrl = null)
{
    $projectId = "first-project-c2a07";
    $serverKey = __DIR__ . '/server_key.json'; // Adjust the path as needed

    try {
        if (!file_exists($serverKey)) {
            throw new Exception("Server key file not found: " . $serverKey);
        }

        // Create service account credentials from JSON key file
        $credential = new ServiceAccountCredentials(
            "https://www.googleapis.com/auth/firebase.messaging",
            json_decode(file_get_contents($serverKey), true)
        );

        // Fetch authentication token
        $token = $credential->fetchAuthToken();

        if (!$token) {
            throw new Exception("Failed to fetch authentication token.");
        }

        // Set curl handle and options
        $ch = curl_init("https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token['access_token'],
        ]);

        // Prepare message body
        $message = [
            'message' => [
                "topic" => $topic,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => [
                    "pageid" => $pageid,
                    "pagename" => $pagename,
                    // "id" => $sendid
                ],
            ],
        ];

        // Add image URL to notification if provided
        if ($imageUrl) {
            $message['message']['notification']['image'] = $imageUrl;
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // This captures the output in a variable
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        // Execute curl request and get response
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("Curl error: " . curl_error($ch));
        }

        curl_close($ch);
        return $response;
    } catch (Exception $e) {
        error_log("Error sending FCM message: " . $e->getMessage());
        return $e->getMessage();
    }
}

function insertUsersNotification($title, $body, $userid, $topic, $pageid, $pagename, $imageUrl)
{
    global $con;

    $statment = $con->prepare("INSERT INTO `notifications`(`notifications_title`, `notifications_body`, `notifications_usersid`) VALUES (?,?,?)");
    $statment->execute([$title, $body, $userid]);
    $count = $statment->rowCount();
    sendFCMMessage($topic, $title, $body, $pageid, $pagename, $imageUrl);
    return $count;
}
function insertAdminNotification($title, $body, $topic, $pageid, $pagename, $imageUrl)
{
    global $con;
    $statment = $con->prepare("INSERT INTO `notifications`(`notifications_title`, `notifications_body`, `notifications_admin`) VALUES (?,?,'1')");
    $statment->execute([$title, $body]);
    $count = $statment->rowCount();
    sendFCMMessage($topic, $title, $body, $pageid, $pagename, $imageUrl);
    return $count;
}



// use Google\Auth\Credentials\ServiceAccountCredentials;
// require 'vendor/autoload.php';

// function sendFCMMessage($topic, $title, $body,$pageid,$pagename, $imageUrl = null) {
//     $projectId = "first-project-c2a07";
//     // $serverKey ="server_key.json";
//     try {
//       // Create service account credentials from JSON key file
//       $credential = new ServiceAccountCredentials(
//         "https://www.googleapis.com/auth/firebase.messaging",
//         json_decode(file_get_contents(__DIR__ . "/server_key.json"), true)
//     );
  
//       // Fetch authentication token
//       $token = $credential->fetchAuthToken();
  
//       // Set curl handle and options
//       $ch = curl_init("https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
//       curl_setopt($ch, CURLOPT_HTTPHEADER, [
//         'Content-Type: application/json',
//         'Authorization: Bearer ' . $token['access_token'],
//       ]);
  
//       // Prepare message body
//       $message = [
//         'message' => [
//             "topic"=> $topic,
//         //   'token' => $fcmToken,
//           'notification' => [
//             'title' => $title,
//             'body' => $body,
//           ],
//           'data'=> [
//             "pageid"=> $pageid,
//             "pagename"=> $pagename
//           ]
//         ],
//       ];
//       // Add image URL to notification if provided
//       if ($imageUrl) {
//         $message['message']['notification']['image'] = $imageUrl;
//       }
//       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // This captures the output in a variable
//       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

//       // Execute curl request and get response
//       $response = curl_exec($ch);
//       return $response;
  
//     } catch (Exception $e) {
//       return $e;
//     }
//   }