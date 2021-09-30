<?php /** @noinspection ForgottenDebugOutputInspection */

use App\Classes\Game;
use App\Classes\Player;
use App\Classes\VictoryDetector;

require_once './vendor/autoload.php';

session_start();

$playerOne = new Player("Mathieu", "Capon");
$playerTwo = new Player("David", "Brylka");
const WINNING_SETS = 3;

$game = new Game($playerOne, $playerTwo, WINNING_SETS);

//starting the game
$game->startNewSet();
echo "SET ". count($game->getSets());
echo "<hr>";

$victoryDetector = new VictoryDetector($game);
$gameWinner = null;

do{
    if($game->getCurrentSet()->isPlaying()){
        $game->getCurrentSet()?->addPointFor(random_int(0, 1) ? $playerOne : $playerTwo);
        echo $game->getCurrentSet()?->getCurrentScoreFormatted() . " / ";
    } else {
        $game->getCurrentSet()->handleWinner();
        $gameWinner = $victoryDetector->handleWinner();

        if($gameWinner === null){
            $game->startNewSet();
            echo "<br>SET ". count($game->getSets())."<hr>";
        }
    }

} while ($gameWinner === null);

echo "<h3>$gameWinner remporte le match</h3>";

dd($game);

