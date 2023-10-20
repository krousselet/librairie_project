<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Exemplaires;
use App\Form\CommandeFormType;
use App\Repository\ExemplairesRepository;
use App\Repository\LivresRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{

    #[Route('/commande/{livreId}', name: 'app_commande')]
    public function commandeId(Security $security, Request $request, ExemplairesRepository $exemplairesRepository, EntityManagerInterface $entityManager, LivresRepository $livreRepository, int $livreId): Response
    {

        $livre = $livreRepository->find($livreId);
        $livre->setQuantite($livre->getQuantite() - 1);
        // dd($quantite);

        // Création d'un nouvel Emprunt (id_exemplaire_id	date_emprunt	date_retour 	livre_id	user_id)

        // $emprunt->setUser($userRepository->find($this));
        //EXEMPLAIRES
        $exemplaire = new Exemplaires();
        $entityManager->persist($exemplaire);
        $entityManager->flush();

        $now = new DateTime(); // Création de la date actuelle
        $emprunt = new Emprunt(); // création de l'id ?
        $userId = $security->getUser();
        $emprunt->setUser($userId); #id user
        $emprunt->setLivre($livreRepository->find($livreId));
//        $emprunt->setDateRetour();


        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emprunt);
            $entityManager->persist($exemplaire);
            $entityManager->persist($livre);
            $entityManager->flush();


            return $this->redirectToRoute('confirm');
        }

        return $this->render('location/commande.html.twig', [
            'now' => $emprunt->getDateEmprunt(),
            'commandeForm' => $form,
            'livre' => $livre,
        ]);
    }
}
