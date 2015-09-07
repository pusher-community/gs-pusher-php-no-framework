<?php
require('../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
?>

<!DOCTYPE html>
<html>
  <head></head>
  <body>
    <h1>Pusher Private Channel Code Sample</h1>
    
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script>
      Pusher.log = function(msg) {
        console.log(msg);
      };
    
      var options = {
        authEndpoint: './private_server.php'
      };
      var appKey = '<?php echo( getenv('PUSHER_APP_KEY') ); ?>';
      var pusher = new Pusher(appKey, options);
      
      var privateChannel = pusher.subscribe('private-my-channel');
      privateChannel.bind('pusher:subscription_succeeded', function() {
        console.log('Success!');
      });
    </script>
  </body>
</html>
