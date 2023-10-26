<?php

namespace App\Domain\Exemplaires\Event;

use App\Domain\Exemplaires\Exemplaires;

class ExemplaireDecrementEvent
{
    public function __construct(private readonly Exemplaires $exemplaires)
    {
    }

    public function getExemplaire(): Exemplaires
    {
        return $this->exemplaires;
    }

}