<?php

namespace App\Domain\Emprunt\Dto;

use App\Domain\Emprunt\Emprunt;
use phpDocumentor\Reflection\Types\Integer;

class EmpruntDto
{
    public  function __construct(
                                public \DateTime $dateEmprunt,
                                public \DateTime $dateRetour,
                                public $quantite,

    )
    {
    }

    public function toEmprunt(): Emprunt
    {
        $emprunt = new Emprunt();
        $emprunt->setDateEmprunt($this->dateEmprunt);
        $emprunt->setDateRetour($this->dateRetour);
        $emprunt->setQuantite($this->quantite);
        return $emprunt;
    }
}