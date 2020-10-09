<!DOCTYPE html>
<html lang="en">
  <head>
    <title>minesweeper</title>
    <meta charset="UTF8">
    <?php
      $columns = 10;
      $rows = 10;
    ?>
    <link rel="stylesheet" href="gamecss.php?columns=<?php echo $columns?>&rows=<?php echo $rows ?>">
    <script>let rows = <?php echo $rows ?>; let columns = <?php echo $columns ?></script>
    <script src="script.js" defer></script>
  </head>
  <body>
    <div id="main-div">
      <div id="board">
        <?php
          for($i = 0; $i < $columns * $rows; $i++)
          {
            echo "<div class='cell'></div>";
          }
        ?>
      </div>
    </div>
  </body>
</html>
