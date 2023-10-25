<?php

namespace App\Domain\Emprunt\Subscriber;

use App\Domain\Emprunt\Event\EmpruntCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Domain\Infrastructure\Mailing\Mailer;

class EmpruntSubscriber implements EventSubscriberInterface
{
    public  function __construct(
        private readonly Mailer $mailer,
    )
    {}

    public  static function getSubscribedEvents(): array
    {
        return [
            EmpruntCreatedEvent::class => 'onCommand',
        ];
    }

    public function onCommand(EmpruntCreatedEvent $event): void
    {
        $email = $this->mailer->createEmail('mails/emprunt/command.html.twig', [
            'emprunt' => $event->getEmprunt(),
        ])
            ->to($event->getEmprunt()->getUser()->getEmail())
            ->subject('Un jour une histoire | Confirmation d\'emprunt');
            $this->mailer->send($email);

    }
}