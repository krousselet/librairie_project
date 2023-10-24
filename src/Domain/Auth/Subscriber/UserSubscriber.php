<?php

namespace App\Domain\Auth\Subscriber;

use App\Domain\Auth\Event\UserCreatedEvent;
use App\Domain\Infrastructure\Mailing\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private readonly Mailer $mailer
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserCreatedEvent::class => 'onRegister',
        ];
    }

    public function onRegister(UserCreatedEvent $event): void
    {
        $email = $this->mailer->createEmail('mails/auth/register.html.twig', [
            'user' => $event->getUser(),
        ])
            ->to($event->getUser()->getEmail())
            ->subject('Un jour une histoire | Confirmation du compte');
        $this->mailer->send($email);
    }
}