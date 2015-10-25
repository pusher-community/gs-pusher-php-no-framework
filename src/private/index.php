<?php
require('../../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv('../../');
$dotenv->load();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pusher Private Channel Code Sample</title>
  
  <link rel="stylesheet" href="../css/styles.css" />
</head>
  <body>
    <?php require_once('../_includes/menu.inc.php'); ?>
    
    <h1>Pusher Private Channel Code Sample</h1>
    
    <p class="description">
      <a href="https://pusher.com/docs/private_channels">Private channels</a> are channels that require authentication. Authentication is made upon subscription and to allow the subscription you must implement an <a href="https://pusher.com/docs/authenticating_users">Authentication endpoint</a> which signs the subscription request.
    </p>
    
    <p class="use-case">
      Private channnels are exactly like public channels, except they require you to authenticate the subscription. The most common use case for private channels is to protect private user or system information.
    </p>
    
    <p>
      You can also trigger events directly on private channels from the client. To do so you must enable client events for your application within the <a href="https://dashboard.pusher.com">Pusher Dashboard</a>. For more information on client events see <a href="https://pusher.com/docs/client_events">the client event docs</a>
    
    <h2>Instructions</h2>
    
    <p class="page-instructions">
      To use this code example, take a look at the source of <a href="https://github.com/pusher-community/gs-pusher-php-no-framework/tree/master/src/private/index.php">index.php</a> and <a href="https://github.com/pusher-community/gs-pusher-php-no-framework/tree/master/src/private/server.php">server.php</a>. Additionally, view the output to the JavaScript console in your browser developer tools.
    </p>
    
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script>
      /*
      Log debug information to the browser console.
      */
      Pusher.log = function(msg) {
        console.log(msg);
      };
    
      /*
      Set options so that `server.php` is called when the presence channel is subscribed to.
      */
      var options = {
        authEndpoint: './server.php'
      };
      var appKey = '<?php echo( getenv('PUSHER_APP_KEY') ); ?>';
      var pusher = new Pusher(appKey, options);
      
      /*
      Subscribe to the presence channel
      */
      var privateChannel = pusher.subscribe('private-my-channel');
      
      /*
      Bind to the subscription success event and handle it with an inline function.
      */
      privateChannel.bind('pusher:subscription_succeeded', function() {
        console.log('Success!');
      });
    </script>
  </body>
</html>
