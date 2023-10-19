<?php

use App\Message\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Mime\Email;
use App\Entity\Emprunt;

class CommandeMailController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    #[Route('/valider_commande', name: 'valider_commande')]


    public function validerCommande(){

        $emprunt = new Emprunt();


        $livre = $emprunt->getLivre();
        $emailUtilisateur = $emprunt->getEmail();

        $email = (new Email())
            ->from('Donnemonargent@signelecheque.com')
            ->to($emailUtilisateur)
            ->subject('Merci pour votre commande de ' . $livre)
            ->html('<p> Nous vous remercions pour votre commande du livre $livre</p>');


        $this->mailer->send($email);

//        return $this->redirectToRoute('profil');
        return new Response('Merci pour votre commande!');
    }
}
