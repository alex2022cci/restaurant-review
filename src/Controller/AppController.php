<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/app', name: 'app')]
    public function index(Restaurant $restaurant): Response
    {
        return $this->render('app/index.html.twig', [
            'Restaurant' => $restaurant,
        ]);
    }
}
