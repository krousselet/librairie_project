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

    #[Route('/commande/{livreId}', name: 'app_commande')]
    public function commandeId(Request $request, EntityManagerInterface $entityManager, ExemplairesRepository $exemplairesRepository, LivresRepository $livreRepository, int $livreId): Response
    {
        // Fetch the corresponding livre using $livreId
        $livre = $livreRepository->find($livreId);

        $exemplaire = new Exemplaires();
        $exemplaire->setIdLivre($livre);
        if (!$exemplaire) {
            // Handle the error, maybe throw an exception or redirect
            throw new \Exception("Exemplaire not found!");
        }

        // Create a new Emprunt
        $emprunt = new Emprunt();

        $now = new \DateTime();
        $emprunt->setUser($this->getUser());
        // $emprunt->setIdExemplaire($exemplaire->getId());
//        $emprunt->setDateemprunt($now);
//        $emprunt->setDateRetour($now);

        // You can associate the $livre with the Emprunt, assuming you have a relationship between Emprunt and Livres
        $emprunt->setLivre($livreRepository->find($livreId));


        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emprunt);
            $entityManager->persist($exemplaire);
            $entityManager->persist($livre);

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
