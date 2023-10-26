<?php

namespace App\Domain\Emprunt\Event;

use App\Domain\Emprunt\Emprunt;

class EmpruntCreatedEvent
{
    public function __construct(private readonly Emprunt $emprunt)
    {
    }

    public function getEmprunt(): Emprunt
    {
        return $this->emprunt;
    }
}