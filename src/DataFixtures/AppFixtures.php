<?php

namespace App\DataFixtures;

use App\Entity\BucketList;
use App\Entity\Category;
use App\Entity\Reaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //crée notre faker pour générer de belles données aléatoires
        $faker = \Faker\Factory::create("fr_FR");
        $category_tab = ['Travel & Adventure', 'Sport', 'Entertainment', 'Human Relations', 'Others'];
        foreach ($category_tab as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }
        $manager->flush();

        // je récupère toutes mes catégories
        $categoryRepository = $manager->getRepository(Category::class);
        $allCategories = $categoryRepository->findAll();

        for($i = 0; $i< 200; $i++) {
            // crée un wish vide
            $wish = new BucketList();

            //hydrate le wish
            $wish-> setTitle($faker->sentence);
            $wish->setDescription($faker->realText());
            $wish->setAuthor($faker->userName);
            $wish->setIsPublished($faker->boolean(85));
            $wish->setDateCreated($faker->dateTimeBetween('-2 years'));
            $wish->setLikes($faker->numberBetween(0, 5000));
            $wish->setCategory($faker->randomElement($allCategories));

            //demande à doctrine de sauvegarder le wish
            $manager->persist($wish);

        }
        //éxécute la requete
        $manager->flush();

        // je récupère toutes mes wishs
        $BucketListRepository = $manager->getRepository(BucketList::class);
        $allWishes = $BucketListRepository->findAll();

        for ($i = 0; $i < 1000; $i++) {
            $reaction = new Reaction();

            $reaction->setUsername($faker->userName);
            $reaction->setMessage($faker->realText());
            $reaction->setDateCreated($faker->dateTimeBetween('-2 years'));
            $reaction->setBucketList($faker->randomElement($allWishes));

            $manager->persist($reaction);
        }

        $manager->flush();

    }
}
