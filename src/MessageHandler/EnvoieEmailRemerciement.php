<?php

    namespace App\MessageHandler;

    use App\Message\Commande;
    use Symfony\Component\Messenger\Attribute\AsMessageHandler;


    #[AsMessageHandler()]

    class EnvoiEmailRemerciement
    {
        private $mailer;

        public function __construct($mailer)
        {
            $this->mailer = $mailer;
        }

        public function __invoke(Commande $message)
        {
            $livre = $message->getLivre();
            $emailUtilisateur = $message->getEmailUtilisateur();
        }
    }
