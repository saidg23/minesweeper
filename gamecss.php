<?php
header("Content-type: text/css");

$rows = $_GET["rows"];
$columns = $_GET["columns"];

$longSide = max($rows, $columns);

$gridSize = "75vmin";
?>

body
{
  color: white;
  background-color: #222222;
  margin: 0;
}

h1
{
  margin-top: 5vh;
}

a
{
  text-decoration: none;
}

#main-div
{
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
}

#board
{
  display: grid;
  grid-template-rows: repeat(<?php echo $rows ?>, calc(<?php echo $gridSize." / ".$longSide ?>));
  grid-template-columns: repeat(<?php echo $columns ?>, calc(<?php echo $gridSize." / ".$longSide ?>));
  grid-gap: 0.5vmin;
}

#timer
{
  font-size: 5vmin;
}

.cell
{
  /* background-color: orange; */
  font-size: calc(<?php echo $gridSize." / ".$longSide?>);

  display: flex;
  align-items: center;
  justify-content: center;
}

.hidden-tile
{
  background-color: dodgerblue;

  width: 100%;
  height: 100%;

  border-radius: 0.8vmin;

  cursor: pointer;
}

.bomb
{
  color: firebrick;
}

.hidden
{
  display: none;
}

.splash
{
  font-size: 10vmin;
  position: fixed;
  top: 0;
  left: 0;

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

  width: 100vw;
  height: 100vh;
}

#splash-text
{
  background-color: #000000dd;
  padding: 2vh;
}

#options
{
  font-size: 2.5vmin;
  display: flex;
  justify-content: space-between;
  margin-top: 2vmin;
  width: 38vmin;
}

.button
{
  color: white;
  background-color: dodgerblue;

  font-weight: bold;

  padding: 0.5em;
  border-radius: 0.4em;
  box-shadow: 0.1em 0.1em white;

  cursor: pointer;
}

.button:hover
{
  background-color: deepskyblue;
}

#endgame-options
{
  font-size: 3vmin;

  display: flex;
  justify-content: space-evenly;

  width: 50vmin;

  padding: 2vmin;
}
