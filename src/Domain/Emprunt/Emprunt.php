<?php

namespace App\Domain\Emprunt;

use App\Domain\Auth\User;
use App\Domain\Emprunt\Repository\EmpruntRepository;
use App\Domain\Exemplaires\Exemplaires;
use App\Domain\Livres\Livres;
use App\Domain\Rendus\Rendus;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

//    #[ORM\ManyToOne(targetEntity: Exemplaires::class, inversedBy: "emprunt")]
//    private ?Exemplaires $id_exemplaire;


//    #[ORM\OneToOne(mappedBy: 'emprunt', cascade: ['persist', 'remove'])]
//    private ?Exemplaires $quantite = null;


//    public function getQuantite(): ?Exemplaires
//    {
//        return $this->quantite;
//    }
//
//    public function setQuantite(?Exemplaires $quantite): void
//    {
//        $this->quantite = $quantite;
//    }

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEmprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\OneToOne(mappedBy: 'id_emprunt', cascade: ['persist', 'remove'])]
    private ?Rendus $rendus = null;

//     #[ORM\ManyToOne(inversedBy: 'emprunts')]
//     private ?Exemplaires $quantite = null;

//    #[ORM\ManyToOne(inversedBy: 'emprunts')]
//    private ?Livres $livre = null;
//
//    #[ORM\ManyToOne(inversedBy: 'emprunts')]
//    #[ORM\JoinColumn(nullable: false)]
//    private ?User $user = null;

//    #[ORM\OneToOne(inversedBy: 'emprunt', cascade: ['persist', 'remove'])]
//    private ?User $userEmpruntId = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): ?int
    {
        return $this->id = $id;
    }

    public function getIdExemplaire(): ?Exemplaires
    {
        return $this->id_exemplaire;
    }

    public function setIdExemplaire(?Exemplaires $id_exemplaire): static
    {
        $this->id_exemplaire = $id_exemplaire;

        return $this;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->dateEmprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $dateEmprunt): static
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getRendus(): ?Rendus
    {
        return $this->rendus;
    }

    public function getLivre(): ?Livres
    {
        return $this->livre;
    }

    public function setLivre(?Livres $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUserEmpruntId(): ?User
    {
        return $this->userEmpruntId;
    }

    public function setUserEmpruntId(?User $userEmpruntId): static
    {
        $this->userEmpruntId = $userEmpruntId;

        return $this;
    }
}
