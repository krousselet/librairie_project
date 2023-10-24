<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Exemplaires;
use App\Form\CommandeFormType;
use App\Repository\ExemplairesRepository;
use App\Repository\LivresRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class CommandeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/commande/{livreId}', name: 'app_commande')]
    public function commandeId(Security $security, Request $request, ExemplairesRepository $exemplairesRepository, EntityManagerInterface $entityManager, LivresRepository $livreRepository, int $livreId): Response
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

        $emprunt = new Emprunt();
        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userId = $security->getUser();
            $emprunt->setUser($userId); #id user
            $emprunt->setLivre($livreRepository->find($livreId));
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
