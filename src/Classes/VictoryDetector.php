<?php


namespace App\Classes;


use function count;

final class VictoryDetector
{

    public function __construct(private Game $game)
    {
    }

    public function handleWinner() : ?Player
    {
        if(!$this->hasEnoughSetsPlayed()){
            return null;
        }

        foreach ($this->game->getPlayers() as $player){
            if($this->hasPlayerEnoughSetsWon($player)){
                return $player;
            }
        }

        return null;
    }

    public function hasEnoughSetsPlayed(): bool
    {
        return $this->game->getSetsCount() >= $this->game->getWinningSetsValue();
    }

    public function hasPlayerEnoughSetsWon(Player $player): bool
    {
        $count = 0;

        foreach($this->game->getSets() as $gameSet){
            if($gameSet->getWinner() === $player){
                $count++;
            }
        }

        return $count === $this->game->getWinningSetsValue();
    }
}
