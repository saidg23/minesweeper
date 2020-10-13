<?php
  $difficulty = $_GET["difficulty"];
  $mysqli = new mysqli("localhost", "client", "", "minesweeper");
  if($mysqli->connect_errno)
  {
    exit($mysqli->connect_error);
  }

  $response = $mysqli->query("SELECT name, time FROM " . $difficulty . "_times order by time");
  if($response != TRUE)
  {
    exit($mysqli->error);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>minesweeper</title>
    <meta charset="UTF8">
    <link rel="stylesheet" href="scoreboard.css">
  </head>
  <body>
    <div id="main-div">
      <h1>SCOREBOARD</h1>
      <div id="difficulty">
        <?php if(strcmp($difficulty, "easy") !== 0): ?>
          <a href="scoreboard.php?difficulty=easy" class="button">Easy</a>
        <?php else: ?>
          <span class="inactive-button">Easy</span>
        <?php endif ?>

        <?php if(strcmp($difficulty, "medium") !== 0): ?>
          <a href="scoreboard.php?difficulty=medium" class="button">Medium</a>
        <?php else: ?>
          <span class="inactive-button">Medium</span>
        <?php endif ?>

        <?php if(strcmp($difficulty, "hard") !== 0): ?>
          <a href="scoreboard.php?difficulty=hard" class="button">Hard</a>
        <?php else: ?>
          <span class="inactive-button">Hard</span>
        <?php endif ?>
      </div>
      <table id="scoreboard">
        <col width="30%">
        <col width="10%">
        <tr>
          <th>Name</th>
          <th>Time</th>
        </tr>
        <?php
          while($row = $response->fetch_row())
          {
            echo "<tr>\n";
            echo "<td>" . $row[0] . "</td>\n";
            echo "<td class='time-cell'>" . date("i:s",$row[1]/1000) . "</td>\n";
            echo "</tr>\n";
          }
          $mysqli->close();
        ?>
      </table>
      <div id="navigation">
        <span class="button">Previous</span>
        <a class="button" href="index.html">Main Menu</a>
        <span class="button">Next</span>
      </div>
    </div>
  </body>
</html>
