<?php

namespace App\DataFixtures;

use App\Entity\Visite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VisiteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // création de faker pour générer aléatoirement des valeurs
        $faker = Factory::create('fr_FR');
        // génération des enregistrements
        for($i=0;$i<100;$i++){
            $visite = new Visite();
            $visite->setVille($faker->city)
                   ->setPays($faker->country)
                   ->setDatecreation($faker->dateTime)
                   ->setNote($faker->numberBetween(0,20))
                   ->setAvis($faker->sentence(4,true))
                   ->setTempsmin($faker->numberBetween(-20,10))
                   ->setTempsmax($faker->numberBetween(10,40));

            $manager->persist($visite);
        }
        $manager->flush();
    }
}
