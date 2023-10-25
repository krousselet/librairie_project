<?php

namespace App\Domain\Livres\Service;

use App\Domain\Livres\Repository\LivresRepository;

class LivreService
{

    public function __construct(private readonly  LivresRepository $livresRepository,
                                private readonly  EventDispatcherInterface $eventDispatcher)
    {
    }

//    public function createLivre(Livres $livres): Livres
//    {
//        $livres->set
//
//            return $livres;
//    }
}