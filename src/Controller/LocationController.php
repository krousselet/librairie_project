<?php

namespace App\Controller;

use App\Repository\LivresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationController extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function displayLocationAvailability(LivresRepository $livreRepository): Response
    {
        return $this->render('location/location.html.twig', [
            'livres' => $livreRepository->findAll(),
        ]);
    }
}
