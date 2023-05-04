<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     * 
     * @param RestaurantRepository $restaurantRepository
     * @param Restaurant $restaurant
     * @return Response
     * 
     * 
    */
    #[Route('/app', name: 'app')]
    public function index( RestaurantRepository $restaurantRepository , Restaurant $restaurant): Response
    {
        $restaurant = $restaurantRepository->findAll();


        return $this->render('app/index.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }
}
