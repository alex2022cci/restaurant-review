<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/restaurant/{:id}', name: 'restaurant')]
    public function index(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/index.html.twig', [
            'controller_name' => $restaurant,
        ]);
    }
}
