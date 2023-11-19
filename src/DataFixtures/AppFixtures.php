<?php

namespace App\DataFixtures;

use App\Domain\Auteur\Auteur;
use App\Domain\Exemplaires\Exemplaires;
use App\Domain\Livres\Livres;
use Couchbase\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasherInterface)
    {
    }
    public function load(ObjectManager $manager): void
    {
        // On choisit la langue dans laquelle on souhaite voir être créé les données
        $faker = Factory::create('fr_FR');
        // on crée 4 auteurs avec noms et prénoms "aléatoires" en français
        for ($i = 0; $i < 12; $i++) {
            // boucle pour créer 11 des auteurs
            $auteurs[$i] = new Auteur();
            $auteurs[$i]->setPrenom($faker->firstName());
            $auteurs[$i]->setNom($faker->lastName());
            $auteurs[$i]->setNomEntie($auteurs[$i]->getNom() . " " . $auteurs[$i]->getPrenom());
            // On mémorise les auteurs dans la db (on le les flush pas encore)
            $manager->persist($auteurs[$i]);
            // nouvelle boucle pour créer des livres
            // Instanciation d'un nouvel objet à chaque itération de boucle
            $livre = new Livres();
            // Une phrase de lorem ipsum pour pour le titre
            $livre->setTitre($faker->sentence(1));
            // Addition du nom plus prénom
            $livre->setAuteur($auteurs[$i]->getNomEntie());
            // nouvelles normes isbn pour les livres
            $livre->setIsbn($faker->isbn13());
            $livre->setDescription($faker->sentence(5));
            // un nombre important de livres, car il faut toujours viser grand
            $livre->setQuantite($faker->numberBetween(0, 100000));
            $manager->persist($livre);

            $exemplaire = new Exemplaires();
            $exemplaire->setIdUtilisateur($user[$i]);
            $manager->persist($exemplaire);
        }

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

        $manager->flush();
    }
}

// Notes : Ne pas oublier de lancer la commande : symfony console d:f:l
