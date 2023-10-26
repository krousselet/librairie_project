<?php

namespace App\Controller;

use App\Domain\Emprunt\Emprunt;
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
    public function commandeId(Request $request, EntityManagerInterface $entityManager, LivresRepository $livreRepository, int $livreId, Emprunt $emprunt): Response
    {
        // Fetch the corresponding livre using $livreId
        $livre = $livreRepository->find($livreId);
        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emprunt);

            $entityManager->flush();

            return $this->redirectToRoute('app_location');
        }

        return $this->render('location/commande.html.twig', [
//            'now' => $emprunt->getDateEmprunt()->format('d-m-Y H:i:s'),
            'commandeForm' => $form,
            'livre' => $livre,
        ]);
    }
}
