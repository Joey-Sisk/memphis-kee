<?php

class Event {
  public function fetch_all() {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM events");
    $query->execute();

    return $query->fetchAll();
  }
}