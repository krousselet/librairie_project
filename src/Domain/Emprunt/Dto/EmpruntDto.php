<?php

namespace App\Domain\Emprunt\Dto;

use App\Domain\Emprunt\Emprunt;
use phpDocumentor\Reflection\Types\Integer;

class EmpruntDto
{
    public  function __construct(
                                public \DateTime $dateEmprunt,
                                public \DateTime $dateRetour,

    )
    {
    }

    public function toEmprunt(): Emprunt
    {
        $emprunt = new Emprunt();
        $emprunt->setDateEmprunt($this->dateEmprunt);
        $emprunt->setDateRetour($this->dateRetour);
        return $emprunt;
    }
}