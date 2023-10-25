<?php

namespace App\Domain\Livres\Event;

use App\Domain\Livres\Livres;

class LivreCreatedEvent
{
    public function __construct(private readonly  Livres $livre)
    {

    }

    public function getLivre(): Livres
    {
        return $this->livre;
    }
}