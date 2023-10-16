<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Exemplaires;
use App\Form\CommandeFormType;
use App\Repository\ExemplairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function commande(Request $request, EntityManagerInterface $entityManager, ExemplairesRepository $exemplaireRepository): Response
    {
        $emprunt = new Emprunt();
        $now = new \DateTime();
        $form = $this->createForm(CommandeFormType::class, $emprunt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $emprunt->setDateemprunt($now);
            $emprunt->setDateRetour($now);
            $exemplaireRepository->findAll();
            $entityManager->persist($emprunt);
            $entityManager->flush();

            return $this->redirectToRoute('app_location');
            dd($emprunt);
        }

        return $this->render('location/commande.html.twig', [
            'now' => $emprunt->getDateEmprunt(),
            'commandeForm' => $form,

        ]);
    }
}
