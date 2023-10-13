<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Auteur;
use App\Entity\Livres;
use App\Entity\Emprunt;
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
            $livre->setTitre($faker->title(8));
            $livre->setAuteur($auteurs[$i]->getNomEntie());
            $livre->setIsbn($faker->isbn13());
            $livre->setQuantite($faker->numberBetween(0, 100000));
            $manager->persist($livre);


            $emprunt = new Emprunt();
            $emprunt->setDateEmprunt($faker->dateTime());

            $manager->persist($emprunt);

            $exemplaire = new Exemplaires();
            $exemplaire->setIdUtilisateur($user[$i]);
            // $exemplaire->setLivres($livre->getTitre($i));
            $exemplaire->setStatut($livre->getQuantite() > 0);
            $manager->persist($exemplaire);
            dd($livre->getQuantite());
        }
        $manager->flush();
    }
}

// Notes : Ne pas oublier de lancer la commande : symfony console d:f:l
