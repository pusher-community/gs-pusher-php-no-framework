<?php
require('../../vendor/autoload.php');
require('../_includes/config.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Pusher Presence Channel Code Sample</title>
    
    <link rel="stylesheet" href="../css/styles.css" />
  </head>
  <body>
    <?php require_once('../_includes/menu.inc.php'); ?>
    
    <h1>Pusher Presence Channel Code Sample</h1>
    
    <p class="description">
      <a href="https://pusher.com/docs/presence_channels">Presence channels</a> are channels that require authentication, much like private channels. They provide real-time information about other users that are subscribed to the channel. You receive an initial list of users via the <code>pusher:subscription_succeeded</code> event, events when users come online via <code>pusher:member_added</code> and events when users go offline via <code>pusher:member_removed</code>.
    </p>
    
    <p class="use-case">
      The most common use case for Presence channels is to build live user lists within a chat rooms scenario. However, don't let this restrict your use case.
    </p>
    
    <h2>Instructions</h2>
    
    <p class="page-instructions">
      To use this code example, take a look at the source of <a href="https://github.com/pusher-community/gs-pusher-php-no-framework/tree/master/src/presence/index.php">index.php</a> and <a href="https://github.com/pusher-community/gs-pusher-php-no-framework/tree/master/src/presence/server.php">server.php</a>. Additionally, view the output to the JavaScript console in your browser developer tools.
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
      var presenceChannel = pusher.subscribe('presence-my-channel');
      
      /*
      Bind to the subscription succeeded event and get an initial list of other users that are subscribed to the channel
      */
      presenceChannel.bind('pusher:subscription_succeeded', subscriptionSucceeded);
      
      /*
      Handled the successful subscription to the channel, receiving a list of users
      that are already online/subscribed to the channel.
      */
      function subscriptionSucceeded(members) {
        console.log('Success!');
        // call addMember for each user already subscribed
        members.each(addMember);
      }
      
      /*
      Bind to the event that is triggered whenever a new user comes online/subscribes to the channel.
      */
      presenceChannel.bind('pusher:member_added', addMember);
      
      /*
      Handle new users coming online.
      */
      function addMember(member) {
        console.log('addMember: ', member.id, member.info);
      }
      
      /*
      Bind to the event that is triggered whenever a user goes offline/unsubscribes from the channel.
      */
      presenceChannel.bind('pusher:member_removed', removeMember);
      
      /*
      Handle users going offline.
      */
      function removeMember(member) {
        console.log('removeMember: ', member.id, member.info);
      }
    </script>
  </body>
</html>
