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
     * @Route("/wishes/", name="wishlist")
     */
    public function list(BucketListRepository $bucketListRepository): Response
    {
        //$buckets = $bucketListRepository->findAll();
        return $this->render('wish/wishlist.html.twig', [
            "buckets" => $bucketListRepository->findAll()
        ]);
    }

    /**
     * @Route("/wishes/{id}", name="wish_detail")
     */
    public function detail(int $id, BucketListRepository $bucketListRepository): Response
    {
        dump($id);
        return $this->render('wish/detailList.html.twig', [
            "wish" => $bucketListRepository->find($id)
        ]);
    }

    /**
     * @Route("/wishes/list/create", name="wish_create")
     */
    public function createWish(EntityManagerInterface $entityManager)
    {
        $bucket = new BucketList();
        $bucket->setTitle('Deathstroke');
        $bucket->setDescription("Restore the Snyderverse");
        $bucket->setAuthor('Slade Wilson');
        $bucket->setIsPublished(1);
        $bucket->setDateCreated(new \DateTime());

        $entityManager->persist($bucket);
        $entityManager->flush();

        die('ok');
    }
}
