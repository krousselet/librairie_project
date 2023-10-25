<?php

namespace App\MessageHandler;


use App\Message\Commande;
use PharIo\Manifest\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler()]

class EnvoiEmailRemerciement
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(Commande $message)
    {
        $livre = $message->getLivre();
        $emailUtilisateur = $message->getEmail();

        $email = (new Email())
            ->from('votre_email@example.com')
            ->to($emailUtilisateur)
            ->subject('Merci pour votre commande de ' . $livre)
            ->html('<p> Nous vous remercions pour votre commande du livre $livre</p>');

        $this->mailer->send($email);
    }
}
