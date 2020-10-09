<?php
header("Content-type: text/css");

$rows = $_GET["rows"];
$columns = $_GET["columns"];

$longSide = max($rows, $columns);

$gridSize = "70vmin";
if($rows > $columns)
{
  $gridSize = "75vmin";
}
?>

body
{
  margin: 0;
}

#main-div
{
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#board
{
  display: grid;
  grid-template-rows: repeat(<?php echo $rows ?>, calc(<?php echo $gridSize." / ".$longSide ?>));
  grid-template-columns: repeat(<?php echo $columns ?>, calc(<?php echo $gridSize." / ".$longSide ?>));
  grid-gap: 0.4vmin;
}

.cell
{
  background-color: orange;
}
