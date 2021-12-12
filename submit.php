<?php
  header("Content-type: text/plain");

  $mysqli = new mysqli("localhost", "client", "", "minesweeper");
  if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  }

  $name = $_POST["name"];
  $time = $_POST["time"];
  $difficulty = $_POST["difficulty"];
  echo $name.", ".$time . "\n";
  $response = $mysqli->query("INSERT INTO " . $difficulty . "_times(name, time) VALUES('" . $name . "'," . $time . ")");

  if ($response === TRUE)
  {
    echo "success\n";
  }
  else
  {
    echo $mysqli->error . "\n";
  }

  $mysqli->close();
?>
