<?php

namespace App\MessageHandler;

use App\Message\CommandeLivreMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

// class EnvoiEmailRemerciementHandler implements MessageSubscriberInterface
// {
//     private $mailer;

//     public function __construct($mailer)
//     {
//         $this->mailer = $mailer;
//     }

//     public function __invoke(CommandeLivreMessage $message)
//     {
//         $livre = $message->getLivre();
//         $emailUtilisateur = $message->getEmailUtilisateur();
//     }
// }
