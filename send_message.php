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






function getToken(){
    $client = new Google\Client();
    $client->setAuthConfig('server_key.json');
    
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

    $accessToken = $client->fetchAccessTokenWithAssertion();

    // if(isset($accessToken['error'])){
    //     echo''. $accessToken['error'] .' wrong';
    // }
   
    return $accessToken['access_token'];
}


function sendMEG($topic,$title,$body){
    $url = "https://fcm.googleapis.com/v1/projects/first-project-c2a07/messages:send";
    $fields = [
        'message' => [
                'topic' => $topic,
                'notification' => [
                        'title' => $title,
                        'body' => $body,
                ],
                    'data' => [
                            'story_id'=>'story_12345'
                    ],
                    'android'=> [
                        'notification'=> [
                          'click_action'=> 'TOP_STORY_ACTIVITY'
                        ]
                    ],
                      'apns'=> [
                        'payload'=> [
                          'aps'=> [
                            'category' => 'NEW_MESSAGE_CATEGORY'
                          ]
                        ]
                      ]
                ]
            ];

    $token = getToken();
    $fields = json_encode($fields,JSON_PRETTY_PRINT);
    $headers = array(
        "Authorization: Bearer $token",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    echo $result; 
    curl_close($ch);
    return $result;
}

?>