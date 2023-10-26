<?php

namespace App\Domain\Auteur\Dto;

use App\Domain\Auteur\Auteur;

class AuteurDto
{
    public  function __construct(
        public string $nom,
        public string $prenom,
        public string $nomEntie,
    )
    {}

    public function toAuteur(Auteur $auteur): Auteur
    {
        $auteur->setNom($this->nom);
        $auteur->setPrenom($this->prenom);
        $auteur->setNomEntie($this->nom . " " . $this->prenom);
            return $auteur;
    }
}