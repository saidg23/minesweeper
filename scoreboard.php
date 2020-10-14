<?php
  $difficulty = $_GET["difficulty"];
  $mysqli = new mysqli("localhost", "client", "", "minesweeper");
  if($mysqli->connect_errno)
  {
    exit($mysqli->connect_error);
  }

  $page = $_GET["page"];

  $response = $mysqli->query("SELECT name, time FROM " . $difficulty . "_times ORDER BY time LIMIT " . ($page - 1) * 10 . ", 11");
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
          <a href="scoreboard.php?difficulty=easy&page=1" class="button">Easy</a>
        <?php else: ?>
          <span class="inactive-button">Easy</span>
        <?php endif ?>

        <?php if(strcmp($difficulty, "medium") !== 0): ?>
          <a href="scoreboard.php?difficulty=medium&page=1" class="button">Medium</a>
        <?php else: ?>
          <span class="inactive-button">Medium</span>
        <?php endif ?>

        <?php if(strcmp($difficulty, "hard") !== 0): ?>
          <a href="scoreboard.php?difficulty=hard&page=1" class="button">Hard</a>
        <?php else: ?>
          <span class="inactive-button">Hard</span>
        <?php endif ?>
      </div>
      <table id="scoreboard">
        <col width="15%">
        <col width="60%">
        <col width="25%">
        <tr>
          <th>Place</th>
          <th>Name</th>
          <th>Time</th>
        </tr>
        <?php
          $rowCount = 0;
          while($row = $response->fetch_row())
          {
            $rowCount++;
            if($rowCount == 11)
            {
              continue;
            }

            echo "<tr>\n";
            echo "<td>" . ($rowCount + ($page - 1) * 10) . "</td>";
            echo "<td>" . $row[0] . "</td>\n";
            echo "<td class='time-cell'>" . date("i:s",$row[1]/1000) . "</td>\n";
            echo "</tr>\n";
          }
          $mysqli->close();
        ?>
      </table>
      <div id="navigation">
        <?php if($page > 1): ?>
          <a class="button" href="scoreboard.php?difficulty=<?php echo $difficulty ?>&page=<?php echo $page - 1?>">Previous</a>
        <?php endif ?>
        <a class="button" href="index.html">Main Menu</a>
        <?php if($rowCount == 11): ?>
          <a class="button" href="scoreboard.php?difficulty=<?php echo $difficulty ?>&page=<?php echo $page + 1?>">Next</a>
        <?php endif ?>
      </div>
    </div>
  </body>
</html>
