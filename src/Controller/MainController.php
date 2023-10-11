<?php

namespace App\Controller;

use App\Form\CommandeFormType;
use App\Repository\LivresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Exemplaires;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/profil', name: 'profil_user')]
    public function profil(): Response
    {
        return $this->render('profil.html.twig');
    }
    #[Route('/location', name: 'app_location')]
    public function location(LivresRepository $livreRepository): Response
    {
        return $this->render('location/location.html.twig', [
            'livres' => $livreRepository->findAll(),
        ]);
    }
    #[Route('/commande', name: 'app_commande')]
    public function commande(): Response
    {
        $exemplaire = new Exemplaires();
        $form = $this->createForm(CommandeFormType::class, $exemplaire);
        return $this->render('location/commande.html.twig', [
            'commandeForm' => $form->createView()
        ]);
    }
}
