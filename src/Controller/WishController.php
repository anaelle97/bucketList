<?php

namespace App\Controller;

use App\Entity\BucketList;
use App\Entity\Category;
use App\Entity\Reaction;
use App\Form\BucketListType;
use App\Form\ReactionType;
use App\Repository\BucketListRepository;
use App\Repository\ReactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/wishes/create", name="wish_create")
     */
    public function createWish(Request $request , EntityManagerInterface $entityManager) {
        // crée une intance de l'entité
        $wish = new BucketList();
        $categories = new Category();
        // crée une intance du formulaire
        $wishForm = $this->createForm(BucketListType::class, $wish);

        // prend les données d'un formulaire soumis et les injecte dans mon $wish
        $wishForm->handleRequest($request);

        // si le formulaire est soumis...
        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            //on s'occupe des propriétés non null et non présent dans le formulaire
            $wish->setDateCreated(new \DateTime());
            $wish->setLikes(0);

            //on va sauvegarder en BDD
            $entityManager->persist($wish);
            $entityManager->flush();

            // Afficher un message flash
            $this->addFlash("success", "Votre souhait a bien été enregistré !");

            //redirige vers une autre page, ou vers la page actuelle pour vider le form
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/createwish.html.twig', [
            "wishForm" => $wishForm->createView()
        ]);
        //
    }


    /**
     * @Route("/wishes/detail/{id}", name="wish_detail")
     */
    public function detail(int $id, Request $request , EntityManagerInterface $entityManager, BucketListRepository $bucketListRepository, ReactionRepository $reactionRepository): Response
    {
        $react = new Reaction();
        $wish = $bucketListRepository->find($id);
        $reactForm = $this->createForm(ReactionType::class, $react);
        $reactForm->handleRequest($request);

        if ($reactForm->isSubmitted() && $reactForm->isValid()) {
            $react->setDateCreated(new \DateTime());
            $react->setBucketList($wish);

            $entityManager->persist($react);
            $entityManager->flush();

            // Afficher un message flash
            $this->addFlash("success", "Votre commentaire a bien été enregistré !");

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/detailList.html.twig', [
            "reactForm" => $reactForm->createView(),
            "wish" => $bucketListRepository->find($id),
            "reactions" => $reactionRepository->findBy([
                'bucketList' => $id
            ])
        ]);
    }


}
