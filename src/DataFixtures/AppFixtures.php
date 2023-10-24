<?php

namespace App\DataFixtures;

use Couchbase\User;
use Faker\Factory;
use App\Entity\Auteur;
use App\Entity\Livres;
use App\Entity\Exemplaires;
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
        // $user = array();
        for ($i = 0; $i < 12; $i++) {
            $user[$i] = new User();
            $user[$i]->setLastName($faker->lastName);
            $user[$i]->setFirstName($faker->firstName);
            $user[$i]->setUsername($faker->userName());
            $user[$i]->setEmail($faker->email);
            $user[$i]->setEmail($faker->email);
            $user[$i]->setAddress($faker->address());
            $password = "test";
            $user[$i]->setPassword($this->userPasswordHasherInterface->hashPassword($user[$i], $password));


            $manager->persist($user[$i]);

            // boucle pour créer des auteurs
            $auteurs[$i] = new Auteur();
            $auteurs[$i]->setPrenom($faker->firstName());
            $auteurs[$i]->setNom($faker->lastName());
            $auteurs[$i]->setNomEntie($auteurs[$i]->getNom() . " " . $auteurs[$i]->getPrenom());


            $manager->persist($auteurs[$i]);
            // nouvelle boucle pour créer des livres
            $livre = new Livres();
            $livre->setTitre($faker->sentence(1));
            $livre->setAuteur($auteurs[$i]->getNomEntie());
            $livre->setIsbn($faker->isbn13());
            $livre->setDescription($faker->sentence(5));
            $livre->setQuantite($faker->numberBetween(0, 100000));

            $manager->persist($livre);

            $exemplaire = new Exemplaires();
            $exemplaire->setIdUtilisateur($user[$i]);
            $manager->persist($exemplaire);
        }
        $manager->flush();
    }
}

// Notes : Ne pas oublier de lancer la commande : symfony console d:f:l
