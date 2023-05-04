<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\User;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
           
        ]);
    }


   
    #[Route('/app', name: 'app')]
    //ToDo : Ajouter la sécurité pour que seul les ADMIN connectés puissent accéder à cette page
    public function app(RestaurantRepository $restaurantRepository, Restaurant $restaurant): Response
    {
        $restaurant = $restaurantRepository->findAll();

        return $this->render('app/index.html.twig', [
            'restaurants' => $restaurant,
        ]);
    }

}
