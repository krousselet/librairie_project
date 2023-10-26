<?php

namespace App\Domain\Avis\Dto;

use App\Domain\Avis\Avis;


class AvisDto
{
public function __construct(
                                public string $commentaire,
                                public float $note,
                                public int $IdUtilisateur,
)
{}
    public function toAvis() :Avis
    {
    $avis = new Avis();
    $avis->setCommentaire($this->commentaire);
    $avis->setNote($this->note);
    $avis->setIdUtilisateur($this->IdUtilisateur);

    return $avis;
    }

}