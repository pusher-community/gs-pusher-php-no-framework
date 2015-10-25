<?php
require('../../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv('../../');
$dotenv->load();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Pusher Trigger Event Code Sample</title>
    
    <link rel="stylesheet" href="../css/styles.css" />
  </head>
  <body>
    <?php require_once('../_includes/menu.inc.php'); ?>
    
    <h1>Pusher Trigger Event Code Sample</h1>
    
    <p class="description">
      Pusher is an Evented PubSub system. This example shows you how to trigger an event on a channel from the server.
    </p>
    
    <p class="use-case">
      This demonstrates the most common and simple use case, simple messaging. It's the foundation upon which most real-time applications and use cases are built upon.
    </p>
    
    <h2>Instructions</h2>
    
    <p class="page-instructions">
      Take a look at the source of <a href="https://github.com/pusher-community/gs-pusher-php-no-framework/tree/master/src/trigger/index.php">index.php</a> and <a href="https://github.com/pusher-community/gs-pusher-php-no-framework/tree/master/src/trigger/server.php">server.php</a>. Additionally, view the output to the JavaScript console in your browser developer tools.
    </p>
    
    <form id="trigger_form" method="post" action="./server.php">
      <p>
        Enter a message in the <code>input</code> and click the <code>Trigger</code> button. This will result in an AJAX request being sent to the <code>server.php</code> script which will trigger an event via Pusher.
      </p>
      <input id="trigger_message" type="text" name="message" placeholder="enter text" />
      <input type="submit" value="Trigger" />
    </form>
    
    <p>Please note, this example also uses jQuery from a CDN.</p>
    
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
      Pusher.log = function(msg) {
        console.log(msg);
      };
    
      var appKey = '<?php echo( getenv('PUSHER_APP_KEY') ); ?>';
      var pusher = new Pusher(appKey);
      
      var channel = pusher.subscribe('my-channel');
      channel.bind('pusher:subscription_succeeded', function() {
        console.log('Success!');
      });
      
      channel.bind('my-event', function(data) {
        alert('A message has been received: ' + data.message);
      });
      
      jQuery('#trigger_form').submit(function(e) {
        e.preventDefault();
        
        var formEl = jQuery(this);
        
        var inputMessage = formEl.find('#trigger_message').val();
        var submitData = {message: inputMessage};
        
        jQuery.post(formEl.attr('action'), submitData);
      });
    </script>
  </body>
</html>
