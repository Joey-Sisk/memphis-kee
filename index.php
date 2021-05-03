<!DOCTYPE html>
<?php
// //Get Heroku ClearDB connection information
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_server = $cleardb_url["host"];
// $cleardb_username = $cleardb_url["user"];
// $cleardb_password = $cleardb_url["pass"];
// $cleardb_db = substr($cleardb_url["path"], 1);
// $active_group = 'default';
// $query_builder = TRUE;
// // Connect to DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// https://www.youtube.com/watch?v=EyEn5gREn_U
?>

<?php

include_once("includes/connection.php");
include_once("includes/event.php");

$event = new Event;
$events = $event->fetch_all();

// print_r($events);

?>

<html lang="en-us">

<!-- https://www.youtube.com/watch?v=QNxU3Qa6QZs -->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/darkly/bootstrap.min.css" integrity="sha384-nNK9n28pDUDDgIiIqZ/MiyO3F4/9vsMtReZK39klb/MtkZI3/LtjSjlmyVPS3KdN" crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <script defer src="./assets/js/script.js"></script>
  <title>Memphis Kee</title>
</head>

<body>
  <!-- Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Memphis Kee</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#story-nav">Story</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tour-nav">Tour</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#merch-nav">Merch</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact-nav">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Carousel Main Image -->
  <div class="container d-flex flex-column min-vh-100">
    <div class="carousel slide" data-bs-ride="carousel" id="carouselControls">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./assets/images/solo-sephia.jpg" class="d-block w-100" alt="Memphis Kee Sephia" />
        </div>
        <div class="carousel-item">
          <img src="./assets/images/cartoon-band.jpg" class="d-block w-100" alt="Cartoon of Band" />
        </div>
        <div class="carousel-item">
          <img src="./assets/images/rock-shot-logo.jpg" class="d-block w-100" alt="Full Band, Black and White in front of rock wall" />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Social Links -->
    <div class="container-fluid">
      <div class="d-flex justify-content-end">
        <a href="https://www.instagram.com/memphis_kee/?hl=en">
          <i class="fa fa-instagram fa-2x p-2" aria-hidden="true"></i>
        </a>
        <a href="https://www.youtube.com/channel/UCtGYy1FuqK0ufQxm3lb5F7A">
          <i class="fa fa-youtube-play fa-2x p-2" aria-hidden="true"></i>
        </a>
        <a href="https://www.facebook.com/memphiskee">
          <i class="fa fa-facebook fa-2x p-2" aria-hidden="true"></i>
        </a>
        <a href="https://twitter.com/memphiskee?lang=en">
          <i class="fa fa-twitter fa-2x p-2" aria-hidden="true"></i>
        </a>
        <a href="https://music.apple.com/us/artist/memphis-kee/1182070266">
          <i class="fa fa-apple fa-2x p-2" aria-hidden="true"></i>
        </a>
        <a href="https://open.spotify.com/artist/3ScaoHVbzeHsyt3z7Rull6">
          <i class="fa fa-spotify fa-2x p-2" aria-hidden="true"></i>
        </a>
      </div>
    </div>

    <!-- About/Story -->
    <h3 id="#story-nav">
      Memphis Kee's Story
    </h3>
    <p>
      Look, no one wants to read a long, pretentious band bio talking about who influenced me to play my first G chord in 1994 (Radiohead) or how I was in the George Jones Fan Club at age 12, so let's keep it to the point. I am a singer/songwriter/band leader that goes by the name Memphis Kee.
    </p>

    <!-- Show Dates -->
    <div id="#tour-nav">
      <h3>Show Dates</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Venue</th>
            <th scope="col">Date/Time</th>
            <th scope="col">About</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($events as $event) {
            echo "<tr>",
            "<td>$event[venue]</td>",
            "<td>", substr($event["event_time"], 0, 16), "</td>",
            "<td>$event[about]</>",
            "</tr>";
          } ?>
        </tbody>
      </table>
    </div>

    <!-- <p><a href="admin">admin</a></p> -->

    <!-- Merch Link -->
    <h3 id="#merch-nav">
      Links to Merchendice
    </h3>
    <p>
      https://memphiskee.bigcartel.com/products
    </p>

    <!-- Contact Form -->
    <form class="mt-3 mb-3" id="#contact-nav" action="https://formspree.io/f/mknpdokj" method="POST">
      <fieldset>
        <div class="form-group">
          <label for="exampleInputEmail1">Your Email</label>
          <input type="email" name="_replyto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
        </div>
        <div class="form-group">
          <label for="exampleTextarea">Message</label>
          <textarea class="form-control" name="message" id="exampleTextarea" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </fieldset>
    </form>

    <!-- Footer -->
    <footer class="mt-auto">
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        <p class="text-muted">Designed by -Joey Sisk-</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/743f6c2984.js"></script>
  </div>


</body>

</html>

<!-- https://bootswatch.com/darkly/ -->
<!-- https://www.bootstrapcdn.com/bootswatch/ -->