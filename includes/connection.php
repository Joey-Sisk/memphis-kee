<?php

try {
  // $pdo = new PDO("mysql:host=localhost;dbname=content_manager",
  //   "root",
  //   "root"
  // );

  $pdo = new PDO("mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_7ae4b30c31e7711",
  "b58647f521efbe",
  "bd5c4eba"
);
  // echo "Connected!";
} catch (PDOException $e) {
  $error = "ERROR! - Connection to DB failed: " . $e->getMessage();
  exit($error);
}
