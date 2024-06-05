<?php

// ==========================================================
//  Copyright Reserved Moahmmed Anwar (Course Ecommerce)
// ==========================================================

define("MB", 1048576);

function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null , $json = true)
{
    global $con;
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT * FROM $table");
    }else{
        $stmt = $con->prepare("SELECT * FROM $table WHERE $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();

    if($json==true){
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    }else{
        if($count>0){
            return $data;
        }else{
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

function imageUpload($imageRequest)
{
    global $msgError;
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
    $imagesize  = $_FILES[$imageRequest]['size'];
    $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
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
        move_uploaded_file($imagetmp,  "../upload/" . $imagename);
        return $imagename;
    } else {
        return "fail";
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

// function result($cout,$successData="nono",$failureMessage="nono"){
//     if($cout>0){
//         printSuccess($successData);
//     }else{
//         printFailure($failureMessage);
//     }
// }
function sendEmail($to,$subject,$body)
{
 

$message = "To complete the verification process, please use the following verification code: [ $body ]. 

Your security and privacy are important to us. 

Best regards".

    $header = "Dear user";
    mail($to, $subject, $message, $header);
}



use Google\Auth\Credentials\ServiceAccountCredentials;
require __DIR__ . '/vendor/autoload.php'; // Adjust the path as needed

function sendFCMMessage($topic, $title, $body, $pageid, $pagename, $imageUrl = null) {
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



// use Google\Auth\Credentials\ServiceAccountCredentials;
// require 'vendor/autoload.php';

// function sendFCMMessage($topic, $title, $body,$pageid,$pagename, $imageUrl = null) {
//     $projectId = "first-project-c2a07";
//     $serverKey ="server_key.json";
//     try {
//       // Create service account credentials from JSON key file
//       $credential = new ServiceAccountCredentials(
//         "https://www.googleapis.com/auth/firebase.messaging",
//         json_decode(file_get_contents($serverKey), true)
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
  
// function sendGCM($title, $message, $topic, $pageid, $pagename)
// {


//     $url = 'https://fcm.googleapis.com/fcm/send';

//     $fields = array(
//         "to" => '/topics/' . $topic,
//         'priority' => 'high',
//         'content_available' => true,

//         'notification' => array(
//             "body" =>  $message,
//             "title" =>  $title,
            // "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            // "sound" => "default"

//         ),
//         'data' => array(
//             "pageid" => $pageid,
//             "pagename" => $pagename
//         )

//     );


//     $fields = json_encode($fields);
//     $headers = array(
//         'Authorization: key=' . "AAAAxfKVswM:APA91bFoUNmeVb2PXuh1rmSR6KZK0uN9K3dRqNGT2GlCjBK-SRzVHNusfHgOO0lF0z97fme2zjzWXlamdhblPeRPExQscSNxwdokr9eETTXmxt4_Q-XRJ_WYszoOrmyak3ZxRBP0qtfg",
//         'Content-Type: application/json'
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//     $result = curl_exec($ch);
//     return $result;
//     curl_close($ch);
// }

//!====================================================================
// function sendFCMNotification($title, $body, $topic, $serviceAccountPath) {
    //     $projectId = "first-project-c2a07";
    //     // URL to the FCM HTTP v1 endpoint
    //     $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';
    
    //     // Get the OAuth 2.0 access token
    //     $accessToken = getAccessToken($serviceAccountPath);
    
    //     // Prepare the request headers
    //     $headers = [
        //         'Authorization: Bearer $accessToken',
        //         'Content-Type: application/json',
        //     ];
        
        //     // Construct the message payload
        //     $data = [
            //         'message' => [
                //             'topic' => $topic,
                //             'notification' => [
                    //                 'title' => $title,
                    //                 'body' => $body,
                    //             ]
                    //         ]
                    //     ];
                    
                    //     // Convert the data to JSON
                    //     $jsonData = json_encode($data,JSON_PRETTY_PRINT);
                    
                    //     // Initialize cURL session
                    //     $ch = curl_init($url);
                    
                    //     // Set cURL options
                    //     curl_setopt($ch, CURLOPT_POST, true);
                    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    
                    //     // Execute the request
                    //     $response = curl_exec($ch);
                    
                    //     // Check for errors
                    //     if ($response === false) {
                        //         echo 'Error: ' . curl_error($ch);
                        //     } else {
                            //         echo 'FCM Response: ' . $response;
                            //     }
                            
                            //     // Close cURL session
//     curl_close($ch);
// }

// function getAccessToken($serviceAccountPath) {
    //     // Load the service account credentials
    //     $credentials = json_decode(file_get_contents($serviceAccountPath), true);
    
    //     // Check if credentials are loaded successfully
    //     if (!$credentials) {
        //         echo "Failed to load service account credentials\n";
        //         return null;
        //     }
        
        //     // Generate JWT token
        //     $jwtToken = generateJWT($credentials);
        
        //     // Prepare the request data
        //     $postData = http_build_query([
            //         'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            //         'assertion' => $jwtToken
            //     ]);
            
            //     // Set up cURL to make the request
            //     $ch = curl_init('https://oauth2.googleapis.com/token');
            //     curl_setopt($ch, CURLOPT_POST, true);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            //     // Execute the request
            //     $response = curl_exec($ch);
            
            //     // Check for errors
            //     if ($response === false) {
                //         echo 'Curl error: ' . curl_error($ch) . "\n";
                //         return null;
                //     }
                
                //     // Close cURL session
                //     curl_close($ch);
                
                //     // Decode the JSON response
                //     $responseData = json_decode($response, true);
                
                //     // Check if access token is present in the response
                //     if (isset($responseData['access_token'])) {
                    //         return $responseData['access_token'];
                    //     } else {
                        //         echo "Failed to get access token from response\n";
                        //         return null;
                        //     }
                        // }
                        
                        // function generateJWT($credentials) {
                            //     // Set up JWT claims
                            //     $claims = [
                                //         'iss' => $credentials['client_email'],
                                //         'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
//         'aud' => 'https://oauth2.googleapis.com/token',
//         'iat' => time(),
//         'exp' => time() + 3600 // Token expires in 1 hour
//     ];

//     // Encode the JWT claims
//     $header = base64_encode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
//     $payload = base64_encode(json_encode($claims));

//     // Load the private key
//     $privateKey = openssl_pkey_get_private($credentials['private_key']);

//     // Sign the JWT
//     openssl_sign("$header.$payload", $signature, $privateKey, 'SHA256');

//     // Encode the signature
//     $encodedSignature = base64_encode($signature);

//     // Return the JWT token
//     return "$header.$payload.$encodedSignature";
// }


//!====================================================================

//*====================================================================

//!====================================================================


// function sendGCM($title, $message, $topic, $pageid, $pagename)
// {
    //     // Path to the service account JSON file
    //     $serviceAccountPath = 'server_key.json';
    
    //     // Get access token
    //     $accessToken = getAccessToken($serviceAccountPath);
    
    
    //     // Prepare the new FCM endpoint URL
    // $projectId = 'first-project-c2a07';
    // $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

    //     // Construct the message payload
    // $fields = array(
    //         'message' => array(
    //                 'topic' => $topic,
    //                 'notification' => array(
    //                         'title' => $title,
    //                         'body' => $message,
    //                         'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
    //                         'sound' => 'default'
    //                     ),
    //                     'data' => array(
    //                             'pageid' => $pageid,
    //                             'pagename' => $pagename
    //                         )
    //                     )
    //                 );
                    
                    //     $fields = json_encode($fields);
                    //     print $fields;
                    //     $headers = array(
                                // 'Authorization: Bearer ' . $accessToken,
                                // 'Content-Type: application/json'
                        //     );
                        
                        //     $ch = curl_init();
                        //     curl_setopt($ch, CURLOPT_URL, $url);
                        //     curl_setopt($ch, CURLOPT_POST, true);
                        //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        
                        //     $result = curl_exec($ch);
//     curl_close($ch);
//     return $result;
// }

//!====================================================================

//*-----------------------------------------------------------------

//*-----------------------------------------------------------------
//!-----------------------------------------------------------------

//!-----------------------------------------------------------------




            
            
            
            
            
            
            
            
            
            
            
            
//([
    // "type"=> "service_account",
    // "project_id"=> "ecommerce-32fc3",
    // "private_key_id"=> "e492704c33603f2d3e148eff254fd5cd13c8ca4c",
    // "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCzz1QDJE0x7dGe\nNYto9d3cXJH2IFXWd51odQEPGmwv9eVY+es2+gtLiU9VK2cPZar6TGo6V51iT7Gk\nJqZQc5I1xoUX0eP/9Ds6Evz2OfI6duqwUYk4b/8FqBGCDh+LhHi8SDSCvPdupv2w\nOGvTdx522MB7WRemcjY/lS307nwEkcxJBIECJukHBQUGMJMkU1XuJhjJnOZoicsh\nzks9P3GziFP0RdgvAFxaoAvE+l/WEyvZlBxk+M2HTI/Qwfgtf+5MiZnw07v3p2ri\nmY+ZZa5xPDQ+G47bclVxcgoraJXC5Kn5s8zlLq5YxWhfGgijNKIecaqwKZsrLeFl\nnSFli5zxAgMBAAECggEAAlgtMb9K7GA77/KlxzARfPqOAqYISHwVxtNjuKUxDO0J\nWQAlM3nOJOV87dDbjqVWNd5CMlGLIUmFuOyyFXF0UhQtDxLzBJbUIN03hCRcRqvf\nQn5FqkE3k4TN+aKigaiwBFBystOw7DXsL9yEd2Thtk38MH+IYeiyUWDqEPv9DPgu\nCIqgsqZvgiTLvx2GGmxwfwFkWO8u4azMDh3fhtfS6oOGnZ9T+EyDubO2PmGgoJwx\nZ1eU35W58T+MPBMpQwvA+QIs7NzSelp6SGVb9QzUumaewbCbodJzpN5yMBJ5j9+a\n3j27+xJDSGl3Xw0aWCI5X+zK+I+5U3OPEsEQpCspiwKBgQD4YDWknAzCw9YiW9tr\nWZ85/dlh7CY1Y+z9lR/N8QZrjyDalrnAR3bCVK07KiZi+J2r6WlepIFWrc6yQ2ZL\n5BOoHZpLtjtdvq9zVM2yXJpS+eahiut3s7khPXWL10rs5hh6PSGzomt7A8KM74ph\n1cWZmRC3JR3TgvxQ3uwijpxOzwKBgQC5VFAP/rQXaLDKbNXp8TAp4toD6XAn2R5O\njI2kLgJFZ4ekKZXNaw/17r/AP8qMTDYh2zM3CTy8gxASF/MqM9kFF/jDNSDhF0cq\n+LUjqxtqE526JyuACGQhYfJKWBySI5nIbIyjutNFtFsmxwycsgAurJMp9mQLAyde\n//vspPZIPwKBgQCWvdVwvSDlh/PLUJKf2XnQuWcYjjk2SBpKYRo3ZCPwXaKj57x+\nnSDPmpK0iMVZZehTsMq5nP++eqgq+sr4Hklry+OcNdJb9+IGDh71NEyZNYAq5OQ5\n9wLR0LopkBWyJ4gNkFKG8nlm5IZMAQmsjRBrQ0Go1cb/Ws0Fy/Xml0T4cwKBgHKj\nd77dI9NTHACrIAtM+Sj/vTIsRQcxI7Ec+kSzfQ4ng10FqDdf4YiUPaKTExyDy/xX\nVi/WE+7b96XpkK3rUnP3JxbBF2yE9K3dGFdO8W9FYQyUTDEvf5iyuKhKJqozQV4b\n30csOqHkdXngKKoI5Vn5wDJ1yd6R/dmi6NeyFvILAoGBAIGJ6kZw8IrdKAWuNV59\ntY9T1Otwh3NBaUESBrNl4yApmwVrGohpM++OS2f/O26S7liYYsIHJKRXBwVZQ8d3\nDpByGrf+3A2ttOyGBcYZjsZtr5DjjRi0bEx8VbBoQ78Q1/6xG04ZkfnOtYRdqVBY\n0ZQep3Yfrj7XheQoru7Ui++k\n-----END PRIVATE KEY-----\n",
    // "client_email"=> "firebase-adminsdk-b02sh@ecommerce-32fc3.iam.gserviceaccount.com",
    // "client_id"=> "110631265573307799361",
    // "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
    // "token_uri"=> "https://oauth2.googleapis.com/token",
    // "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
    // "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-b02sh%40ecommerce-32fc3.iam.gserviceaccount.com",
    // "universe_domain"=> "googleapis.com"
  //]);

  #use Google\Client; // Import the Google_Client class
  
  // function getAccessToken() {
  //     $credentialsPath = './server_key.json'; // Replace with the actual path to your service account JSON file
  
  //     $client = new Client();
  //     $client->setAuthConfig($credentialsPath);
  //     $client->setScopes(['https://www.googleapis.com/auth/firebase.messaging']);
  
  //     $token = $client->fetchAccessTokenWithAssertion();
  
  //     if (isset($token['error'])) {
  //         throw new Exception('Error fetching access token: ' . $token['error']);
  //     }
  
  //     return $token['access_token'];
  // }


//   require 'vendor/autoload.php';
// use Google\Auth\Credentials\ServiceAccountCredentials;
// use Google\Auth\HttpHandler\HttpHandlerFactory;


  //function sendMessage() {

    
    // $credentialsPath = 'server_key.json'; // Ensure this path is correct and the file is accessible

    // $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
   // $credentialsPath = new ServiceAccountCredentials(
    //     "https://www.googleapis.com/auth/firebase.messaging",
    //     json_decode(file_get_contents("server_key.json"),true)
    // );
    //$credentials = new ServiceAccountCredentials($scopes, $credentialsPath);
    // $httpHandler = HttpHandlerFactory::build();
    // $token = $credentials->fetchAuthToken($httpHandler);

    // if (!isset($token['access_token'])) {
    //     throw new Exception('Failed to fetch access token');
    // }

    // $accessToken = $token['access_token'];

    // $url = "https://fcm.googleapis.com/v1/projects/ecommerce-32fc3/messages:send";

    // $headers = [
    //     'Content-Type: application/json',
    //     'Authorization: Bearer ' . $accessToken,
    // ];

    // $postData = [
    //     'message' => [
    //         'topic' => 'users',
    //         'notification' => [
    //             'title' => 'Breaking News',
    //             'body' => 'New news story available.',
    //         ],
    //         'data' => [
    //             'story_id' => 'story_12345',
    //         ],
    //     ],
    // ];

    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //$response = curl_exec($ch);

    // if ($response === false) {
    //     $error = curl_error($ch);
    //     curl_close($ch);
    //     throw new Exception('Curl error: ' . $error);
    // }

    // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // curl_close($ch);

    // if ($httpCode != 200) {
    //     throw new Exception('Failed to send message, HTTP code: ' . $httpCode . ', response: ' . $response);
    // }

    // return $response;
//}
// function sendMessage() {
//     $credentialsPath = 'server_key.json'; // Ensure this path is correct and the file is accessible

//     try {
//         // Define the required scopes for Firebase Cloud Messaging
//         $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

//         // Initialize ServiceAccountCredentials
//         $credentials = new ServiceAccountCredentials($scopes, $credentialsPath);
//         $httpHandler = HttpHandlerFactory::build();
        
//         // Fetch the access token using the service account credentials
//         $token = $credentials->fetchAuthToken($httpHandler);

//         // Check if there was an error while fetching the token
//         if (!isset($token['access_token'])) {
//             throw new Exception('Failed to fetch access token');
//         }

//         $accessToken = $token['access_token'];

//         // Set the URL for the FCM endpoint
//         $url = "https://fcm.googleapis.com/v1/projects/ecommerce-32fc3/messages:send";

//         // Set the headers and payload for the request
//         $headers = [
//             'Content-Type: application/json',
//             'Authorization: Bearer ' . $accessToken,
//         ];

//         $postData = [
//             'message' => [
//                 'topic' => 'users',
//                 'notification' => [
//                     'title' => 'Breaking News',
//                     'body' => 'New news story available.',
//                 ],
//                 'data' => [
//                     'story_id' => 'story_12345',
//                 ],
//             ],
//         ];

//         // Initialize cURL
//         $ch = curl_init($url);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//         // Execute the cURL request and capture the response
//         $response = curl_exec($ch);

//         if ($response === false) {
//             $error = curl_error($ch);
//             curl_close($ch);
//             throw new Exception('Curl error: ' . $error);
//         }

//         // Check the HTTP status code
//         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//         curl_close($ch);

//         if ($httpCode != 200) {
//             throw new Exception('Failed to send message, HTTP code: ' . $httpCode . ', response: ' . $response);
//         }

//         return $response;

//     } catch (Exception $e) {
//         // Log or print the exception message for debugging
//         error_log('Error: ' . $e->getMessage());
//         throw $e; // Re-throw the exception after logging
//     }
// }


//   function sendMessage() {

//     $credentialsPath = new ServiceAccountCredentials(
//         ["https://www.googleapis.com/auth/firebase.messaging"],
//         json_decode(file_get_contents("server_key.json"),true)
//     );

//     $token = $credentialsPath->fetchAuthToken(HttpHandlerFactory::build());

//     $ch = curl_init("https://fcm.googleapis.com/v1/projects/ecommerce-32fc3/messages:send");

//     curl_setopt($ch,CURLOPT_HTTPHEADER,[
//         'Content-Type: application/json',
//         'Authorization: Bearer ' . $token['access_token']
//     ]);

//     curl_setopt($ch,CURLOPT_POSTFIELDS,'{
//         "message": {
//           "topic": "users",
//           "notification": {
//             "title": "Breaking News",
//             "body": "New news story available."
//           },
//           "webpush" : {
//             "fcm_options" : {
//                 "link": "https://google.com"
//             }
//           }
//           "data": {
//             "story_id": "story_12345"
//           }
//         }
//       }');

//       curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'post');
//       $response = curl_exec($ch);
//       curl_close($ch);
//       echo $response;
//     }


    // $credentialsPath = './server_key.json'; // Ensure this path is correct and the file is accessible

    // try {
    //     // Initialize the Google Client
    //     $client = new Client();
        
    //     // Set the path to the service account credentials
    //     $client->setAuthConfig($credentialsPath);
        
    //     // Set the required scopes for Firebase Cloud Messaging
    //     $client->setScopes(['https://www.googleapis.com/auth/firebase.messaging']);

    //     // Fetch the access token using the service account credentials
    //     $token = $client->fetchAccessTokenWithAssertion();

    //     // Check if there was an error while fetching the token
    //     if (isset($token['error'])) {
    //         throw new Exception('Error fetching access token: ' . $token['error']);
    //     }

    //     // Return the access token
    //     echo $token['access_token'];
    //     return $token['access_token'];
    // } catch (Exception $e) {
    //     // Log or print the exception message for debugging
    //     error_log('Error: ' . $e->getMessage());
    //     throw $e; // Re-throw the exception after logging
    // }
   



