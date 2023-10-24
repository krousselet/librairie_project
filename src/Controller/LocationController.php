<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Exemplaires;
use App\Repository\ExemplairesRepository;
use App\Repository\LivresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationController extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function displayLocationAvailability(LivresRepository $livreRepository, ExemplairesRepository $exemplairesRepository,Security $security, EntityManagerInterface $entityManager): Response
    {
        $livres = $livreRepository->findAll();


        return $this->render('location/location.html.twig', [
            'livres' => $livres,
            'exemplaires' => $exemplairesRepository->findAll(),
        ]);
    }
}
