<?php

session_start();

include_once("../includes/connection.php");
include_once("../includes/event.php");

$event = new Event;

if (isset($_SESSION["logged_in"])) {
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = $pdo->prepare("DELETE FROM events WHERE id = ?");
    $query->bindValue(1, $id);
    $query->execute();

    header("Location: delete.php");
  }

  $events = $event->fetch_all();
?>
  <html>

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

      <h4>Select an event to delete:</h4>

      <form action="delete.php" method="get">
        <select onChange="this.form.submit();" name="id">
          <?php foreach ($events as $event) {
            echo "<option value=$event[id]>",
            "$event[venue] $event[event_date]",
            "</option>";
          } ?>
        </select>
      </form>

    </div>


  </body>

  </html>

<?php

} else {
  header("Location: index.php");
}
?>