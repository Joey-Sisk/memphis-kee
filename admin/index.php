<!DOCTYPE html>
<?php

session_start();

include_once("../includes/connection.php");

if (isset($_SESSION["logged_in"])) {
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

      <ul>
        <li>
          <a href="add.php">Add Event</a>
        </li>
        <li>
          <a href="delete.php">Delete Event</a>
        </li>
        <li>
          <a href="logout.php">Logout</a>
        </li>
      </ul>

    </div>


  </body>

  </html>

<?php
} else {
  if (isset($_POST["name"], $_POST["password"])) {
    $username = $_POST["name"];
    $password = $_POST["password"];

    if (empty($username) or empty($password)) {
      $error = "All fields are required!";
    } else {
      $query = $pdo->prepare("SELECT * FROM users WHERE name = ? AND password = ?");

      $query->bindValue(1, $username);
      $query->bindValue(2, $password);

      $query->execute();

      $num = $query->rowCount();

      if ($num == 1) {
        // user entered correct details
        $_SESSION["logged_in"] = true;
        header("Location: index.php");
        exit();
      } else {
        // user entered false details
        $error = "Incorrect Username and Password";
      }
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

      <br /><br />

      <?php if (isset($error)) {
        echo "<p>$error</p><br />";
      } ?>

      <form action="index.php" method="post" autocomplete="off">
        <input type="text" name="name" placeholder="Username" /><br />
        <input type="password" name="password" placeholder="Password" /><br />
        <input type="submit" value="Login" />
      </form>

    </div>


  </body>

  </html>

<?php

}

?>