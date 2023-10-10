<?php

namespace App\Controller;

use App\Repository\LivresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
