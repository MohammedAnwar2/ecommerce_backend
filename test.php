<?php
include "send_message.php";
// sendMEG("users", "my name is mohammed", "2121");

// Usage
$serviceAccountFile = 'server_key.json';
$title = 'Test Notification';
$body = 'This is a test notification.';
$token = 'recipient-device-token'; // The device token you want to send the notification to

$response = sendNotification($title, $body, $token, $serviceAccountFile);
echo $response;

?>