<?php

namespace App\Domain\Exemplaires;

use App\Domain\Auth\User;
use App\Domain\Emprunt\Emprunt;
use App\Domain\Exemplaires\Repository\ExemplairesRepository;
use App\Domain\Livres\Livres;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExemplairesRepository::class)]
class Exemplaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

//    #[ORM\OneToOne(inversedBy: 'exemplaires', cascade: ['persist', 'remove'])]
//    private ?User $id_utilisateur = null;
//
//    #[ORM\OneToOne(inversedBy: 'exemplaires', cascade: ['persist', 'remove'])]
//    private ?Livres $id_livre = null;
// 14:44


    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $statut = false;

    #[ORM\Column]
    private ?int $quantite = 0;

//    #[ORM\OneToOne(mappedBy: 'id_exemplaire', cascade: ['persist', 'remove'])]
//    private ?Livres $livres = null;
// 14:44


//    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: "id_exemplaire")]
//    private $emprunt;
// 14: 44


    public function getId(): ?int
    {
        return $this->id;
    }

//    public function getIdUtilisateur(): ?User
//    {
//        return $this->id_utilisateur;
//    }
// 14 : 44

//    public function setIdUtilisateur(?User $id_utilisateur): static
//    {
//        $this->id_utilisateur = $id_utilisateur;
//
//        return $this;
//    }
// 14 : 44

//    public function getIdLivre(): ?Livres
//    {
//        return $this->id_livre;
//    }

//    public function setIdLivre(?Livres $id_livre): static
//    {
//        $this->id_livre = $id_livre;
//
//        return $this;
//    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEtat(): array
    {
        return $this->etat;
    }

    public function setEtat(array $etat): static
    {
        $this->etat = $etat;

        return $this;
    }



    public function getLivres(): ?Livres
    {
        return $this->livres;
    }

    public function getEmprunt(): ?Emprunt
    {
        return $this->emprunt;
    }

    public function getStatut(): bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        return $this;
    }
}
