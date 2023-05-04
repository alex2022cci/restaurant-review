<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/restaurant", name="restaurant")
     * @param RestaurantRepository $restaurantRepository
     * @param Restaurant $restaurant
     * @return Response
     * 
    */
    #[Route('/restaurant', name: 'restaurant')]
    public function index(RestaurantRepository $restaurantRepository,  Restaurant $restaurant): Response
    {
        $restaurant = $restaurantRepository->findAll();

        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurant,
            
        ]);
    }
}
