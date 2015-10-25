<?php
require('../../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv('../../');
$dotenv->load();

$appId = getenv('PUSHER_APP_ID');
$appKey = getenv('PUSHER_APP_KEY');
$appSecret = getenv('PUSHER_APP_SECRET');

$pusher = new Pusher($appKey, $appSecret, $appId);

/*
Uncomment this to have internal Pusher PHP library logging
information echoed in the response to the incoming request
*/

// class EchoLogger {
//   public function log($msg) {
//     echo($msg);
//   }
// }
// 
// $pusher->set_logger(new EchoLogger());

$channelName = $_POST['channel_name'];
$socketId = $_POST['socket_id'];

/*
TODO: implement checks to determine if the user is:
1. Authenticated with the app
2. Allowed to subscribe to the $channelName
3. Sanitize any additional data that has been recieved and is to be used

If so, proceed...
*/

$auth = $pusher->socket_auth($channelName, $socketId);

header('Content-Type: application/json');
echo($auth);
