<?php
require('../../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv('../../');
$dotenv->load();
?>

<!DOCTYPE html>
<html>
  <head></head>
  <body>
    <?php require_once('../_includes/menu.inc.php'); ?>
    
    <h1>Pusher Trigger Event Code Sample</h1>
    
    <p>Please note, this example also uses jQuery from a CDN.</p>
    
    <form id="trigger_form" method="post" action="./server.php">
      <input id="trigger_message" type="text" name="message" />
      <input type="submit" value="Trigger" />
    </form>
    
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
