<?php

namespace App\Controller;

use App\Domain\Emprunt\Emprunt;
use App\Domain\Exemplaires\Exemplaires;
use App\Domain\Exemplaires\Repository\ExemplairesRepository;
use App\Domain\Livres\Repository\LivresRepository;
use App\Form\CommandeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/commande/{livreId}', name: 'app_commande')]
    public function commandeId(Request $request, EntityManagerInterface $entityManager, ExemplairesRepository $exemplairesRepository, LivresRepository $livreRepository, int $livreId): Response
    {
        $now = new DateTime();

        $livre = $livreRepository->find($livreId);

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
            $entityManager->persist($emprunt);
            $entityManager->persist($exemplaire);
            $entityManager->persist($livre);

            $entityManager->flush();


            return $this->redirectToRoute('confirm');
        }

        return $this->render('location/commande.html.twig', [
            'now' => $emprunt->getDateEmprunt()->format('d-m-Y H:i:s'),
            'commandeForm' => $form,
            'livre' => $livre,
        ]);
    }
}
