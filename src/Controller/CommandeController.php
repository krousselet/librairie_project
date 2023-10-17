<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Exemplaires;
use App\Entity\Livres;
use App\Form\CommandeFormType;
use App\Repository\ExemplairesRepository;
use App\Repository\LivresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{

    #[Route('/commande/{livreId}', name: 'app_commande')]
    public function commandeId(Request $request, EntityManagerInterface $entityManager, ExemplairesRepository $exemplairesRepository, LivresRepository $livreRepository, int $livreId): Response
    {
        // Fetch the corresponding livre using $livreId
        $livre = $livreRepository->find($livreId);
        $exemplaire = new Exemplaires();
        $exemplaire = $exemplairesRepository->find($livreId);

        // Create a new Emprunt
        $emprunt = new Emprunt();

        $now = new \DateTime();
        $emprunt->setDateemprunt($now);
        $emprunt->setDateRetour($now);

        // You can associate the $livre with the Emprunt, assuming you have a relationship between Emprunt and Livres
        $emprunt->setLivre($livreRepository->find($livreId));


        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emprunt->setIdExemplaire($livreRepository->find($livreId));
            $emprunt->setId($emprunt->getId() + 1);
            $entityManager->persist($exemplaire);
            $entityManager->persist($emprunt);
            $entityManager->flush();

            return $this->redirectToRoute('app_location');
        }

        return $this->render('location/commande.html.twig', [
            'now' => $emprunt->getDateEmprunt()->format('d-m-Y H:i:s'),
            'commandeForm' => $form,
            'livre' => $livre,
        ]);
    }
}
