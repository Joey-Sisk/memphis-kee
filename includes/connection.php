<?php

try {
  $pdo = new PDO("mysql:host=localhost;dbname=content_manager",
    "root",
    "root"
  );
  // echo "Connected!";
} catch (PDOException $e) {
  $error = "ERROR! - Connection to DB failed: " . $e->getMessage();
  exit($error);
}
