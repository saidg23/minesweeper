
function bombProximity(x, y)
{
    if(bombs[x + columns * (y + 1)] && boundCheck(x, y + 1)) return true;
    else if(bombs[(x + 1) + columns * (y + 1)] && boundCheck(x + 1, y + 1)) return true;
    else if(bombs[(x + 1) + columns * y] && boundCheck(x + 1, y)) return true;
    else if(bombs[(x + 1) + columns * (y - 1)] && boundCheck(x + 1, y - 1)) return true;
    else if(bombs[x + columns * (y - 1)] && boundCheck(x, y - 1)) return true;
    else if(bombs[(x - 1) + columns * (y - 1)] && boundCheck(x - 1, y - 1)) return true;
    else if(bombs[(x - 1) + columns * y] && boundCheck(x - 1, y)) return true;
    else if(bombs[(x - 1) + columns * (y + 1)] && boundCheck(x - 1, y + 1)) return true;

    return false;
}

function bombCount(x, y)
{
    let count = 0;
    if(bombs[x + columns * (y + 1)] && boundCheck(x, y + 1)) count++;
    if(bombs[(x + 1) + columns * (y + 1)] && boundCheck(x + 1, y + 1)) count++;
    if(bombs[(x + 1) + columns * y] && boundCheck(x + 1, y)) count++;
    if(bombs[(x + 1) + columns * (y - 1)] && boundCheck(x + 1, y - 1)) count++;
    if(bombs[x + columns * (y - 1)] && boundCheck(x, y - 1)) count++;
    if(bombs[(x - 1) + columns * (y - 1)] && boundCheck(x - 1, y - 1)) count++;
    if(bombs[(x - 1) + columns * y] && boundCheck(x - 1, y)) count++;
    if(bombs[(x - 1) + columns * (y + 1)] && boundCheck(x - 1, y + 1)) count++;

    return count;
}

function boundCheck(x, y)
{
    return !(x < 0 || x >= columns || y < 0 || y >= rows);
}

function onClick(x, y)
{
    if(timerInterval == null)
    {
        timerInterval = setInterval(updateTime, 1000);
        startTime = new Date();
    }

    revealTile(x, y);
    checkWin();
}

function revealTile(x, y)
{
    let index = x + columns * y;
    if(!boundCheck(x, y) || revealed[index]) return;

    if(bombs[index])
    {
        gameOver();
        tiles[index].innerHTML = "<span class='bomb'>*</span>";
        return;
    }

    if(bombProximity(x, y))
    {
        revealed[index] = true;
        tiles[index].innerHTML = bombCount(x, y);
        return;
    }

    revealed[index] = true;

    tiles[index].innerHTML = "";

    revealTile(x, y + 1);
    revealTile(x + 1, y + 1);
    revealTile(x + 1, y);
    revealTile(x + 1, y - 1);
    revealTile(x, y - 1);
    revealTile(x - 1, y - 1);
    revealTile(x - 1, y );
    revealTile(x - 1, y + 1);
}

function getRandom(min, max)
{
    return Math.floor((Math.random() * (max - min + 1))  + min);
}

function checkWin()
{
    for(let i = 0; i < revealed.length; ++i)
    {
        if(!revealed[i] && !bombs[i])
        {
            return;
        }
    }

    stopTimer();
    splashText.innerHTML = "YOU WIN!";
    endScreen.className = "splash";
    submitButton.className = "button";
    console.log("you win");
}

function gameOver()
{
    stopTimer();
    splashText.innerHTML = "YOU LOSE!";
    endScreen.className = "splash";
    console.log("game over");
}

function initGame()
{
    revealed = [];
    bombs = [];
    for(let i = 0; i < tiles.length; ++i)
    {
        revealed.push(false);
        bombs.push(false);
    }

    let numberOfBombs = 10;
    switch(difficulty)
    {
        case "medium": numberOfBombs = 30; break;
        case "hard": numberOfBombs = 50; break;
        default: break;
    }


    let bombsPlaced = 0;
    while(bombsPlaced < numberOfBombs)
    {
        let randomLocation = getRandom(0, bombs.length);
        if(bombs[randomLocation]) continue;
        bombs[randomLocation] = true;
        bombsPlaced++;
    }
    timer = new Date();
    timer.setTime(0);
}

function updateTime()
{
    let currentTime = new Date();

    timer.setTime(currentTime.getTime() - startTime.getTime());
    let minutes = timer.getMinutes();
    let seconds = timer.getSeconds();
    if(minutes < 10) minutes = '0' + minutes;
    if(seconds < 10) seconds = '0' + seconds;

    timerElement.innerHTML = minutes + ":" + seconds;
}

function stopTimer()
{
    clearInterval(timerInterval);
}

function checkRequest()
{
    if(http.readyState === XMLHttpRequest.DONE)
    {
        var status = http.status;
        if (status === 0 || (status >= 200 && status < 400))
        {
            window.location.href = "http://localhost:80/scoreboard.php?difficulty=" + difficulty;
        }
    }
}

function submitTime()
{

    http = new XMLHttpRequest();
    http.open("POST", "http://localhost:80/submit.php");
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.onreadystatechange = checkRequest;
    http.send("name=" + name + "&time=" + timer.getTime() + "&difficulty=" + difficulty);
    // httpInterval = setInterval(getTable, 1000);
}

function getTable()
{
    if(http.readyState != 4) return;

    console.log(http.responseText);
    clearInterval(httpInterval);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////

let tiles = document.getElementsByClassName("cell");
let timerElement = document.getElementById("timer");
let endScreen = document.getElementById("end-screen");
let splashText = document.getElementById("splash-text");
let submitButton = document.getElementById("time-submit-button");

let revealed = null;
let bombs = null;
let timer = null;
let startTime = null;
let timerInterval = null;
let http = null;
let httpInterval = null;
initGame();

// for(let i = 0; i < tiles.length; ++i)
// {
//     if(bombs[i]) tiles[i].innerHTML = "X";
// }
