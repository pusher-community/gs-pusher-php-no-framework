<?php
require('../../vendor/autoload.php');
require('../_includes/config.php');

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

/*
TODO: implement checks to determine if the user is:
1. Authenticated with the app
2. Allowed to trigger on the channel
3. Sanitize any additional data that has been recieved and is to be used

If so, proceed...
*/

$messageFromUser = $_POST['message'];
$eventData = ['message' => $messageFromUser];

$result = $pusher->trigger('my-channel', 'my-event', $eventData);

/*
Uncomment this to have the HTTP Pusher API response
information echoed in the response to the incoming request
*/
// echo($result);
