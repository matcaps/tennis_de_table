<?php


namespace App\Classes;


use LogicException;

use function array_values;
use function implode;

final class SetOfGame
{
    private Player $playerOne;
    private Player $playerTwo;

    private const POINTS_OF_SET = 11;
    private ?Player $winner = null;
    private array $currentScore;

    public function __construct(Player $playerOne, Player $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;

        $this->currentScore = [
            $this->playerOne->getId() => 0,
            $this->playerTwo->getId() => 0
        ];
    }

    public function getCurrentScoreFormatted(): string
    {
        return implode(" - ", array_values($this->currentScore));
    }

    public function addPointFor(Player $player): void
    {
        if ($this->isPlaying()) {
            $this->currentScore[$player->getId()] += 1;
        } else {
            throw new LogicException("le set est déja terminé");
        }
    }

    public function isPlaying(): bool
    {
        if (!$this->hasElevenPointsOrMore()) {
            return true;
        }

        if (!$this->hasTwoPointsBetweenPlayers()) {
            return true;
        }

        return false;
    }

    public function hasElevenPointsOrMore(): bool
    {
        return $this->currentScore[$this->playerOne->getId()] >= self::POINTS_OF_SET
            || $this->currentScore[$this->playerTwo->getId()] >= self::POINTS_OF_SET;
    }

    public function hasTwoPointsBetweenPlayers(): bool
    {
        return abs(
                $this->currentScore[$this->playerOne->getId()] -
                $this->currentScore[$this->playerTwo->getId()]
            ) > 1;
    }

    public function handleWinner(): void
    {
        if ($this->isPlaying()) {
            return;
        }

        if (($this->currentScore[$this->playerOne->getId()] >= 11) && $this->hasTwoPointsBetweenPlayers()) {
            $this->winner = $this->playerOne;
        }

        if (($this->currentScore[$this->playerTwo->getId()] >= 11) && $this->hasTwoPointsBetweenPlayers()) {
            $this->winner = $this->playerTwo;
        }
    }

    public function getWinner(): ?Player
    {
        return $this->winner;
    }

}
