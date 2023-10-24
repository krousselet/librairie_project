<?php

namespace App\Controller;

use App\Domain\Emprunt\Emprunt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RetourController extends AbstractController
{
    #[Route('/retour/{empruntId}', name: 'app_retour')]
    public function returnBook(Request $request, EntityManagerInterface $entityManager, int $empruntId): Response
    {
        $emprunt = $entityManager->getRepository(Emprunt::class)->find($empruntId);

        // Check if the emprunt exists and belongs to the logged-in user
        if (!$emprunt || $emprunt->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('app_location');
        }

        // Set the return date to the current time
        $emprunt->setDateRetour(new \DateTime());
        $entityManager->flush();

        $this->addFlash('success', 'Book returned successfully!');

        return $this->redirectToRoute('app_location');
    }
}
