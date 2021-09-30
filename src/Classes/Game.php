<?php

namespace App\Classes;

use ErrorException;

use function count;
use function end;

final class Game
{
    private array $sets = [];

    public function __construct(
        private Player $playerOne,
        private Player $playerTwo,
        private int $winningSets
    ){
    }

    public function startNewSet(): void{

        $set = new SetOfGame($this->playerOne, $this->playerTwo);
        $this->sets[] = $set;

    }

    public function getCurrentSet() : ?SetOfGame{

        if($this->getSetsCount() === 0 ){
            throw new ErrorException("Aucun set n'a démarré.");
        }

        return end($this->sets);
    }

    public function getSets(): array
    {
        return $this->sets;
    }

    public function getSetsCount(): int
    {
        return count($this->sets);
    }

    public function getWinningSetsValue(): int
    {
        return $this->winningSets;
    }

    public function getPlayers(): array
    {
        return [$this->playerOne, $this->playerTwo];
    }




}
