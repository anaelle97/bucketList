<?php

namespace App\DataFixtures;

use App\Entity\BucketList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //crée notre faker pour générer de belles données aléatoires
        $faker = \Faker\Factory::create("fr FR");

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

            //demande à doctrine de sauvegarder le wish
            $manager->persist($wish);

        }

        //éxécute la requete
        $manager->flush();

    }
}
