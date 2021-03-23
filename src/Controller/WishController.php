<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wishes/", name="wishlist")
     */
    public function list(): Response
    {
        return $this->render('wish/wishlist.html.twig', [

        ]);
    }

    /**
     * @Route("/wishes/{id}", name="wish_detail")
     */
    public function detail(int $id): Response
    {
        dump($id);
        return $this->render('wish/detailList.html.twig', [
        ]);
    }
}
