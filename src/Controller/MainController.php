<?php

namespace App\Controller;

use App\Repository\EmpruntRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/confirm', name: 'confirm')]
    public function confirm(EmpruntRepository $empruntRepository): Response
    {
//        $empruntId = $empruntRepository->find(empruntId);
        $all = $empruntRepository->findAll();
        return $this->render('confirm/confirmation.html.twig');
    }

}
