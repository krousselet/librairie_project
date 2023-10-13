<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Form\CommandeFormType;
use App\Repository\EmpruntRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function commande(EmpruntRepository $empruntRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $emprunt = new Emprunt();
        $now = new \DateTime();
        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $emprunt->setDateemprunt($now);
            // $emprunt->setDateRetour();
            // $emprunt->setDateRetour();
            $entityManager->persist($emprunt);
            $entityManager->flush();

            return $this->redirectToRoute('app_commande');
        }

        return $this->render('location/commande.html.twig', [
            'now' => $emprunt->getDateEmprunt(),
            'commandeForm' => $form,
            'all' => $empruntRepository->findAll()

        ]);
    }
}
