<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Exemplaires;
use App\Form\CommandeFormType;
use App\Repository\ExemplairesRepository;
use App\Repository\LivresRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class CommandeController extends AbstractController
{

    #[Route('/commande/{livreId}', name: 'app_commande')]
    public function commandeId(UserRepository $userRepository, Security $security, Request $request, ExemplairesRepository $exemplairesRepository, EntityManagerInterface $entityManager, LivresRepository $livreRepository, int $livreId): Response
    {
        $now = new DateTime();

        $livre = $livreRepository->find($livreId);
        $livre->setQuantite($livre->getQuantite() - 1);

        // $emprunt->setUser($userRepository->find($this));
        //EXEMPLAIRES

        $exemplaire = new Exemplaires();
        $entityManager->persist($exemplaire);

        $now = new DateTime(); // Création de la date actuelle
        $oneWeekLater = (clone $now)->modify('+1 week');
        $oneMonthLater = (clone $now)->modify('+1 month');

//        $emprunt->setDateRetour();

        $emprunt = new Emprunt(); // création de l'id ?
        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $userId = $security->getUser();
            $emprunt->setUser($userId); #id user
            $emprunt->setLivre($livreRepository->find($livreId));
            $throw =true;
            $entityManager->persist($emprunt);
            $entityManager->persist($exemplaire);
            $entityManager->persist($livre);
            $entityManager->flush();


            //Bryan
            $emprunt = new Emprunt();
            $throw = false;
            $mailer = $this->get('mailer');
            $livre = $emprunt->getLivre();
//            $emailUtilisateur = $emprunt->getEmail();
            $emailUtilisateur = $userRepository->find(70);
            $emailUtilisateur->getEmail();
            dd($emailUtilisateur);

            $email = (new Email())

                ->from('Donnemonargent@signelecheque.com')
                ->to($emailUtilisateur)
                ->subject('Merci pour votre commande de ' . $livre)
                ->text('testest');

            if (!$throw){
            $mailer->send($email);
            }
            //Bryan


            return $this->redirectToRoute('confirm');
        }

        return $this->render('location/commande.html.twig', [
            'now' => $emprunt->getDateEmprunt(),
            'commandeForm' => $form,
            'livre' => $livre,
        ]);
    }
}
