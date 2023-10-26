<?php

namespace App\Controller;

use App\Domain\Emprunt\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/confirm', name: 'confirm')]
    public function confirm(EmpruntRepository $empruntRepository): Response
    {
//        $empruntId = $empruntRepository->find(empruntId);
        $all = $empruntRepository->findAll();
        return $this->render('confirm/confirmation.html.twig');
    }

}
