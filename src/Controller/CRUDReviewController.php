<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/CRUDreview')]
class CRUDReviewController extends AbstractController
{
    #[Route('/', name: 'app_c_r_u_d_review_index', methods: ['GET'])]
    public function index(ReviewRepository $reviewRepository): Response
    {
        return $this->render('crud_review/index.html.twig', [
            'reviews' => $reviewRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_r_u_d_review_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReviewRepository $reviewRepository): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewRepository->save($review, true);

            return $this->redirectToRoute('app_c_r_u_d_review_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_review/new.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_r_u_d_review_show', methods: ['GET'])]
    public function show(Review $review): Response
    {
        return $this->render('crud_review/show.html.twig', [
            'review' => $review,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_r_u_d_review_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Review $review, ReviewRepository $reviewRepository): Response
    {
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewRepository->save($review, true);

            return $this->redirectToRoute('app_c_r_u_d_review_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_review/edit.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_r_u_d_review_delete', methods: ['POST'])]
    public function delete(Request $request, Review $review, ReviewRepository $reviewRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $reviewRepository->remove($review, true);
        }

        return $this->redirectToRoute('app_c_r_u_d_review_index', [], Response::HTTP_SEE_OTHER);
    }
}
