<?php

namespace App\Controller;

use App\Entity\BucketList;
use App\Repository\BucketListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wishes/{page}", name="wishlist", requirements={"page": "\d+"})
     */
    public function list(BucketListRepository $bucketListRepository, int $page = 1): Response
    {
        $result = $bucketListRepository->findWishList($page);
        $wishes = $result['result'];

        //$buckets = $bucketListRepository->findAll();
        return $this->render('wish/wishlist.html.twig', [
           // "buckets" => $bucketListRepository->findBy(["isPublished" => 1], ["dateCreated" => "DESC"], 20, 0)
            "buckets" => $wishes,
            "totalResultCount" => $result['totalResultCount'],
            "currentPage" => $page,
        ]);
    }

    /**
     * @Route("/wishes/detail/{id}", name="wish_detail")
     */
    public function detail(int $id, BucketListRepository $bucketListRepository): Response
    {
        dump($id);
        return $this->render('wish/detailList.html.twig', [
            "wish" => $bucketListRepository->find($id)
        ]);
    }


}
