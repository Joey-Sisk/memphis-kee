<?php

session_start();

include_once("../includes/connection.php");

if (isset($_SESSION["logged_in"])) {
  if (isset(
    $_POST["venue"],
    $_POST["event_time"],
    $_POST["about"]
  )) {
    $venue = $_POST["venue"];
    $event_time = $_POST["event_time"];
    $about = nl2br($_POST["about"]);

    if (empty($venue) or empty($event_time) or empty($about)) {
      $error = "All fields are required.";
    } else {
      $query = $pdo->prepare("INSERT INTO events (venue, event_time, about) VALUES (?, ?, ?)");

      $query->bindValue(1, $venue);
      $query->bindValue(2, $event_time);
      $query->bindValue(3, $about);

      $query->execute();

      header("Location: index.php");
    }
  }
?>

  <html lang="en-us">

  <!-- https://www.youtube.com/watch?v=QNxU3Qa6QZs -->

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>CMS</title>
  </head>

  <body>

    <div class="container">
      <a href="index.php" id="logo">CMS</a>

      <br />

      <h4>
        Add Event
      </h4>
      <br />

      <?php if (isset($error)) {
        echo "<p>$error</p><br />";
      } ?>

      <form action="add.php" method="post" autocomplete="off">
        <input type="text" name="venue" placeholder="Venue"><br />
        <label for="event_time">When is the event?</label><br />
        <input type="datetime-local" name="event_time"><br />
        <textarea name="about" cols="30" rows="6" placeholder="About the event"></textarea><br />
        <input type="submit" value="Add Event">
      </form>

    </div>


  </body>

  </html>

<?php
} else {
  header("Location: index.php");
}

?>