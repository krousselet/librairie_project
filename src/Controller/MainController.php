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
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
