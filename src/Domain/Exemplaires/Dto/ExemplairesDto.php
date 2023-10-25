<?php

namespace App\Domain\Exemplaires\Dto;

use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;
use App\Domain\Exemplaires\Exemplaires;

class ExemplairesDto
{

        public function __construct(
                        public Integer $quantite,
                        public Boolean $etat,
                        public string $livre,
                        public string $emprunt,
                        public Boolean $statut,
                        public Integer $IdLivre,
                                    )
    {

    }

    public function toExemplaire() :Exemplaires
    {
        $exemplaire = new Exemplaires();
        $exemplaire->setQuantite($this->quantite);
        $exemplaire->setEtat($this->etat);
        $exemplaire->setLivres($this->livre);
        $exemplaire->setEmprunt($this->emprunt);
        $exemplaire->setStatut($this->statut);
        $exemplaire->setIdLivre($this->IdLivre);

        return $exemplaire;
    }

}