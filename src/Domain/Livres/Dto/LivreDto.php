<?php

namespace App\Domain\Livres\Dto;

use App\Domain\Livres\Livres;

class LivreDto
{

    public function __construct(
                                public string $titre,
                                public string $auteur,
//                                public string $editeur, Il faudra veiller à vérifier le Array en type de donnée
                                public string $isbn)
    {
    }

    public function  toLivres(): Livres
    {
        $livre = new Livres();
        $livre->setTitre($this->titre);
        $livre->setAuteur($this->auteur);
//        $livre->setediteur($this->[]);
        return $livre;
    }
}