<!DOCTYPE html>
<?php

include_once("includes/connection.php");
include_once("includes/event.php");

$event = new Event;
$events = $event->fetch_all();

// print_r($events);

?>

<!-- https://www.youtube.com/watch?v=QNxU3Qa6QZs -->

<html lang="en-us">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <script defer src="./assets/js/script.js"></script>
  <title>Memphis Kee</title>
</head>

<body>
  <!-- Nav Bar -->
  <nav class="nav-bar">
    <a class="nav-item nav-link" href="#">Memphis Kee</a>
    <a class="nav-item nav-link" href="#">Home</a>
    <a class="nav-item nav-link" href="#">Tour</a>
    <a class="nav-item nav-link" href="#">Story</a>
    <a class="nav-item nav-link" href="#">Merch</a>
  </nav>

  <!-- Hero Image/Maybe Video -->
  <div class="hero-container">
    <div class="hero-content">
      <h1>Memphis Kee</h1>
      <p>Shred Dirt Country</p>
    </div>
  </div>

  <!-- Social Links -->


  <!-- Show Dates -->
  <div>
    <h3>Show Dates</h3>
    <ul>
      <?php foreach ($events as $event) {
        echo "<li>",
        "<h3>Location: $event[venue]</h3>",
        "<p>Date: $event[event_date]</p>",
        "<p>Time: ", substr($event["event_time"], 0, 5), "</p>",
        "<p>About: $event[about]</p>",
        "</li>";
      } ?>
    </ul>
  </div>

  <!-- Contact Form -->
  <div class="form-container">
    <form action="https://formspree.io/f/mknpdokj" method="POST">
      <fieldset>
        <label for="inputEmail1">Your Email</label>
        <input class="form-inputs" type="email" name="_replyto" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
        <label for="textarea">Message</label>
        <textarea class="form-inputs" name="message" rows="3"></textarea>
        <button type="submit">Submit</button>
      </fieldset>
    </form>
  </div>

  <!-- Footer -->
  <!-- <footer>
      <div>
        <p>Designed by -Joey Sisk-</p>
      </div>
    </footer> -->

    <p><a href="admin">admin</a></p>
</body>

</html>

<!-- https://bootswatch.com/darkly/ -->
<!-- https://www.bootstrapcdn.com/bootswatch/ -->