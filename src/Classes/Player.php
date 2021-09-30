<?php


namespace App\Classes;


use function base64_encode;
use function spl_object_hash;

final class Player
{

    public function __construct(
        private string $firstname,
        private string $lastname,
    ) {
    }

    public function getId(): string
    {
        return spl_object_hash($this);
    }

    public function __toString(): string
    {
        return $this->firstname. " ".$this->lastname;
    }
}
