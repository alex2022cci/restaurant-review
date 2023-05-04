<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/c/r/u/d/restaurant')]
class CRUDRestaurantController extends AbstractController
{
    #[Route('/', name: 'app_c_r_u_d_restaurant_index', methods: ['GET'])]
    public function index(RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('crud_restaurant/index.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_r_u_d_restaurant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RestaurantRepository $restaurantRepository): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantRepository->save($restaurant, true);

            return $this->redirectToRoute('app_c_r_u_d_restaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_restaurant/new.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_r_u_d_restaurant_show', methods: ['GET'])]
    public function show(Restaurant $restaurant): Response
    {
        return $this->render('crud_restaurant/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_r_u_d_restaurant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Restaurant $restaurant, RestaurantRepository $restaurantRepository): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantRepository->save($restaurant, true);

            return $this->redirectToRoute('app_c_r_u_d_restaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_restaurant/edit.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_r_u_d_restaurant_delete', methods: ['POST'])]
    public function delete(Request $request, Restaurant $restaurant, RestaurantRepository $restaurantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
            $restaurantRepository->remove($restaurant, true);
        }

        return $this->redirectToRoute('app_c_r_u_d_restaurant_index', [], Response::HTTP_SEE_OTHER);
    }
}
