<?php /*
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
echo "data: The server time is: {$time}\n\n";
flush(); */
?>
<?php 
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/New_York");
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");

$counter = rand(1, 10);
while (true) {
  // Every second, send a "ping" event.

  echo "event: ping\n";
  $curDate = date('r');
  echo 'data: {"time": "' . $curDate . '"}';
  echo "\n\n";

  // Send a simple message at random intervals.

  $counter--;

  if (!$counter) {
    echo 'data: This is a message at time ' . $curDate . "\n\n";
    $counter = rand(1, 10);
  }

  ob_end_flush();
  flush();

  // Break the loop if the client aborted the connection (closed the page)

  if ( connection_aborted() ) break;

  sleep(1);
}

?>