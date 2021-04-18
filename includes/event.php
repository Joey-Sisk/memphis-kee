<?php

class Event
{
  public function fetch_all()
  {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM events");
    $query->execute();

    return $query->fetchAll();
  }

  public function fetch_data($id)
  {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $query->bindValue(1, $id);
    $query->execute();

    return $query->fetch();
  }
}
