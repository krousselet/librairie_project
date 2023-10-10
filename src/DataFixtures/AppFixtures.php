<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Livres;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasherInterface)
    {
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        // on crée 4 auteurs avec noms et prénoms "aléatoires" en français
        $auteurs = array();
        for ($i = 0; $i < 12; $i++) {
            $auteurs[$i] = new User();
            $auteurs[$i]->setLastName($faker->lastName);
            $auteurs[$i]->setFirstName($faker->firstName);
            $auteurs[$i]->setUsername($faker->userName());
            $auteurs[$i]->setEmail($faker->email);
            $auteurs[$i]->setEmail($faker->email);
            $auteurs[$i]->setAddress($faker->address());
            $password = "test";
            $auteurs[$i]->setPassword($this->userPasswordHasherInterface->hashPassword($auteurs[$i], $password));


            $manager->persist($auteurs[$i]);
        }
        // nouvelle boucle pour créer des livres

        // $livres = array();

        for ($i = 0; $i < 12; $i++) {

            //$livres[$i] = new Livres();
            $livre = new Livres();
            $livre->setTitre($faker->title());
            $livre->setAuteur($auteurs[$i]->getFirstName());
            $livre->setIsbn($faker->isbn13());
            $livre->setQuantite($faker->numberBetween(0, 100000));


            //$livres[$i]->setTitre($faker->sentence(3));
            //$livres[$i]->$faker->setIsbn(13);

            $manager->persist($livre);
        }

        $manager->flush();
    }
}

// Notes : Ne pas oublier de lancer la commande : symfony console d:f:l
