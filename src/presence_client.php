<?php
require('../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
?>

<!DOCTYPE html>
<html>
  <head></head>
  <body>
    <h1>Pusher Presence Code Sample</h1>
    
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script>
      Pusher.log = function(msg) {
        console.log(msg);
      };
    
      var options = {
        authEndpoint: './presence_server.php'
      };
      var appKey = '<?php echo( getenv('PUSHER_APP_KEY') ); ?>';
      var pusher = new Pusher(appKey, options);
      
      var presenceChannel = pusher.subscribe('presence-my-channel');
      presenceChannel.bind('pusher:subscription_succeeded', function(members) {
        console.log('Success!');
        members.each(addMember);
      });
      
      function addMember(member) {
        console.log('addMember: ', member.id, member.info);
      }
      
      function removeMember(member) {
        console.log('removeMember: ', member.id, member.info);
      }
    </script>
  </body>
</html>
