<?php
require('../vendor/autoload.php');

$appId = getenv('PUSHER_APP_ID');
$appKey = getenv('PUSHER_APP_KEY');
$appSecret = getenv('PUSHER_APP_SECRET');

$pusher = new Pusher($appKey, $appSecret, $appId);

$pusher.trigger('channel-name', 'event-name', ['some' => 'data']);
