<?php

namespace App\Domain\Emprunt\Subscriber;

use App\Domain\Emprunt\Event\EmpruntCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EmpruntSubscriber implements EventSubscriberInterface
{

    public  static function getSubscribedEvents(): array
    {
        return [
            EmpruntCreatedEvent::class => 'onCommand',
        ];
    }

    public function onCommand(EmpruntCreatedEvent $event): EmpruntCreatedEvent
    {
        $oldQuantity = $event->getEmprunt()->getQuantite();
        return $oldQuantity - 1;
    }
}