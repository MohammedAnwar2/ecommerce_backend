<?php



// require_once 'vendor/autoload.php';

// use Google\Client as GoogleClient;

// function getAccessToken() {
//     $client = new GoogleClient();
//     $client->setAuthConfig('server_key.json'); // Update the path to your service account file
//     $client->addScope('https://www.googleapis.com/auth/firebase.messaging'); // Add any necessary scopes

//     $accessToken = $client->fetchAccessTokenWithAssertion();

//     if (isset($accessToken['error'])) {
//         throw new Exception('Error fetching access token: ' . $accessToken['error_description']);
//     }

//     return $accessToken['access_token'];
// }

// function sendMEG($topic, $title, $body) {
//     $url = 'https://fcm.googleapis.com/v1/projects/first-project-c2a07/messages:send';

//     $fields = [
//         'message' => [
//             'topic' => $topic,
//             'notification' => [
//                 'title' => $title,
//                 'body' => $body,
//             ],
//             'data' => [
//                 'story_id' => 'story_12345'
//             ],
//             'android' => [
//                 'notification' => [
//                     'click_action' => 'TOP_STORY_ACTIVITY'
//                 ]
//             ],
//             'apns' => [
//                 'payload' => [
//                     'aps' => [
//                         'category' => 'NEW_MESSAGE_CATEGORY'
//                     ]
//                 ]
//             ]
//         ]
//     ];

//     $token = getAccessToken();
//     $fields = json_encode($fields, JSON_PRETTY_PRINT);
//     $headers = [
//         "Authorization: Bearer $token",
//         'Content-Type: application/json'
//     ];

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//     $result = curl_exec($ch);

//     if (curl_errno($ch)) {
//         throw new Exception('Curl error: ' . curl_error($ch));
//     }

//     curl_close($ch);

//     return $result;
// }






// function getToken(){
//     $client = new Google\Client();
//     $client->setAuthConfig('server_key.json');
    
//     $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

//     $accessToken = $client->fetchAccessTokenWithAssertion();

//     // if(isset($accessToken['error'])){
//     //     echo''. $accessToken['error'] .' wrong';
//     // }
   
//     return $accessToken['access_token'];
// }


// function sendMEG($topic,$title,$body){
//     $url = "https://fcm.googleapis.com/v1/projects/first-project-c2a07/messages:send";
//     $fields = [
//         'message' => [
//                 'topic' => $topic,
//                 'notification' => [
//                         'title' => $title,
//                         'body' => $body,
//                 ],
//                     'data' => [
//                             'story_id'=>'story_12345'
//                     ],
//                     'android'=> [
//                         'notification'=> [
//                           'click_action'=> 'TOP_STORY_ACTIVITY'
//                         ]
//                     ],
//                       'apns'=> [
//                         'payload'=> [
//                           'aps'=> [
//                             'category' => 'NEW_MESSAGE_CATEGORY'
//                           ]
//                         ]
//                       ]
//                 ]
//             ];

//     $token = getToken();
//     $fields = json_encode($fields,JSON_PRETTY_PRINT);
//     $headers = array(
//         "Authorization: Bearer $token",
//         'Content-Type: application/json'
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//     $result = curl_exec($ch);
//     echo $result; 
//     curl_close($ch);
//     return $result;
// }






// require 'vendor/autoload.php';

// use \Firebase\JWT\JWT;

// function sendNotification($title, $body, $token, $serviceAccountFile) {
//     // Your Firebase project ID
//     $projectId = 'first-project-c2a07';

//     // Get the service account key
//     $serviceAccount = json_decode(file_get_contents($serviceAccountFile), true);

//     // Create a JWT for Firebase authentication
//     $now_seconds = time();
//     $payload = array(
//         "iss" => $serviceAccount['client_email'],
//         "sub" => $serviceAccount['client_email'],
//         "aud" => "https://fcm.googleapis.com/",
//         "iat" => $now_seconds,
//         "exp" => $now_seconds + (60*60),  // Maximum expiration time is one hour
//         "scope" => "https://www.googleapis.com/auth/firebase.messaging"
//     );

//     $jwt = JWT::encode($payload, $serviceAccount['private_key'], 'RS256');

//     // Prepare the notification payload
//     $notification = [
//         'message' => [
//             'token' => $token,
//             'notification' => [
//                 'title' => $title,
//                 'body' => $body,
//             ],
//         ],
//     ];

//     // Send the notification
//     $url = "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";
//     $headers = [
//         'Authorization: Bearer ' . $jwt,
//         'Content-Type: application/json',
//     ];

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
//     $response = curl_exec($ch);

//     if ($response === FALSE) {
//         die('Curl failed: ' . curl_error($ch));
//     }

//     curl_close($ch);

//     return $response;
// }







/* 
https://fcm.googleapis.com/v1/projects/<YOUR-PROJECT-ID>/messages:send
Content-Type: application/json
Authorization: Bearer <YOUR-ACCESS-TOKEN>

{
  "message": {
    "token": "eEz-Q2sG8nQ:APA91bHJQRT0JJ...",
    "notification": {
      "title": "Background Message Title",
      "body": "Background message body"
    },
    "webpush": {
      "fcm_options": {
        "link": "https://dummypage.com"
      }
    }
  }
}
 */



// use Google\Auth\Credentials\ServiceAccountCredentials;
// use Google\Auth\HttpHandler\HttpHandlerFactory;

// require 'vendor/autoload.php';

// $credential = new ServiceAccountCredentials(
//     "https://www.googleapis.com/auth/firebase.messaging",
//     json_decode(file_get_contents("server_key.json"), true)
// );

// $token = $credential->fetchAuthToken(HttpHandlerFactory::build());

// $ch = curl_init("https://fcm.googleapis.com/v1/projects/first-project-c2a07/messages:send");

// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'Content-Type: application/json',
//     'Authorization: Bearer '.$token['access_token']
// ]);

// curl_setopt($ch, CURLOPT_POSTFIELDS, '{
//     "message": {
//       "token": "cPO5ZrCvTv2Qgkg1HRv2Oz:APA91bEz05xVUDQ1iurKHzWzVSTkzlAe8FnX1FmLDlXqjsDehlMicPFmI5y0h0EXix6257TgNTn0hhYRK-S04Mgpn2mtCx3qJfz7wFMBSjLlbtG6Cip3j8SMDf3aCEwIIc_UCL8-wkJ7",
//       "notification": {
//         "title": "Background Message Title",
//         "body": "Background message body",
//         "image": "https://cdn.shopify.com/s/files/1/1061/1924/files/Sunglasses_Emoji.png?2976903553660223024"
//       },
//       "webpush": {
//         "fcm_options": {
//           "link": "https://google.com"
//         }
//       }
//     }
//   }');

//   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "post");

//   $response = curl_exec($ch);

//   curl_close($ch);

//   echo $response;


 
 include "functions.php";
 $topic = "users";
 $title = "Mohammed anwar";
 $body = "i am happy1240000000000000000";
 $pageid="";
 $pagename="";
 $imageUrl = "https://cdn.shopify.com/s/files/1/1061/1924/files/Sunglasses_Emoji.png?2976903553660223024"; 
 $response = sendFCMMessage($topic, $title, $body,$pageid,$pagename, $imageUrl);
 
 