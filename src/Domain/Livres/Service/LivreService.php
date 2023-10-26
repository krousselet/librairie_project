<?php

namespace App\Domain\Livres\Service;

use App\Domain\Livres\Event\LivreCreatedEvent;
use App\Domain\Livres\Livres;
use App\Domain\Livres\Repository\LivresRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LivreService
{

    public function __construct(private readonly  LivresRepository $livresRepository,
                                private readonly  EventDispatcherInterface $eventDispatcher)
    {
    }

//    public function createLivre(Livres $livres): Livres
//    {
//        $livres->setTitre();
//        $this->livresRepository->save($livres, true);
//        $this->eventDispatcher->dispatch(new LivreCreatedEvent($livres));
//
//            return $livres;
//    } A faire plus tard
}