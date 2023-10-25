<?php

namespace App\Controller;

use App\Domain\Exemplaires\Repository\ExemplairesRepository;
use App\Domain\Livres\Repository\LivresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function displayLocationAvailability(LivresRepository $livreRepository, ExemplairesRepository $exemplairesRepository,Security $security, EntityManagerInterface $entityManager): Response
    {
        $livres = $livreRepository->findAll();
        $exemplaires = $exemplairesRepository->findAll();


        return $this->render('location/location.html.twig', [
            'livres' => $livres,
            'exemplaires' => $exemplaires,

        ]);
    }
}
