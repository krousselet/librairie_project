<?php

namespace App\Domain\Exemplaires\Dto;

use App\Domain\Exemplaires\Exemplaires;

class ExemplairesDto
{

        public function __construct(
                        public int $quantite,
                        public array $etat,
                        public bool $statut,
                        public int $IdLivre,
                                    )
    {

    }

    public function toExemplaire() :Exemplaires
    {
        $exemplaire = new Exemplaires();
        $exemplaire->setQuantite($this->quantite);
        $exemplaire->setEtat($this->etat);
        $exemplaire->setStatut($this->statut);
        $exemplaire->setIdLivre($this->IdLivre);

        return $exemplaire;
    }

}