<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RessourcesController extends AbstractController
{
    #[Route('/ressources', name: 'ressources')]
    public function index(): Response
    {
        return $this->render('ressources/ressources.html.twig', [
            'controller_name' => 'RessourcesController',
        ]);
    }
}
