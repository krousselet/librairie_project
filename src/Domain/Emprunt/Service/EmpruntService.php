<?php

namespace App\Domain\Emprunt\Service;


use App\Domain\Emprunt\Emprunt;
use App\Domain\Emprunt\Event\EmpruntCreatedEvent;
use App\Domain\Emprunt\Repository\EmpruntRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EmpruntService
{
    public function __construct(private readonly  EmpruntRepository $empruntRepository,
                                private readonly  EventDispatcherInterface $eventDispatcher)
    {
    }

    public function createEmprunt(Emprunt $emprunt): Emprunt
    {
        $now = new \DateTime();
        $emprunt->setDateEmprunt($now);
      //  $emprunt->setDateRetour($form->getData()); Il s'agira ici de récupérer l'input du formulaire (1 semaine vs 1 mois)

        $this->empruntRepository->save($emprunt, true);
        $this->eventDispatcher->dispatch(new EmpruntCreatedEvent($emprunt));
        return $emprunt;
    }
}