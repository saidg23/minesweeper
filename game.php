<?php
  $difficulty = $_GET["difficulty"];
  $columns = 13;
  $rows = 10;

  if(strcmp($difficulty, "medium") == 0)
  {
    $columns = 16;
    $rows = 13;
  }
  else if(strcmp($difficulty, "hard") == 0)
  {
    $columns = 19;
    $rows = 16;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>minesweeper</title>
    <meta charset="UTF8">
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="gamecss.php?columns=<?php echo $columns?>&rows=<?php echo $rows ?>">
      <script>
        let rows = "<?php echo $rows?>";
        let columns = "<?php echo $columns?>";
        let difficulty = "<?php echo $difficulty?>";
        let name = "<?php echo $_GET["name"]?>";
      </script>
    <script src="script.js" defer></script>
  </head>
  <body>
    <div id="main-div">
      <h1>MINESWEEPER</h1>
      <div id="timer-div">
        <span id="timer">00:00</span>
      </div>
      <div id="board">
        <?php
          for($i = 0; $i < $columns * $rows; $i++)
          {
            echo "<div class='cell'><div class='hidden-tile' onclick='onClick(".$i % $columns.", ".intdiv($i, $columns).")'></div></div>";
          }
        ?>
      </div>
      <div id="options">
        <a class="button" href="index.html">Main Menu</a>
        <span class="button" onclick="location.reload()">Restart</span>
      </div>
    </div>
    <div id="end-screen" class="hidden">
      <div id="splash-text">YOU WIN!</div>
      <div id="endgame-options">
        <span id="time-submit-button" class="hidden" onclick="submitTime()">Submit Time</span>
        <span class="button" onclick="location.reload()">Try Again</span>
      </div>
    </div>
  </body>
</html>
