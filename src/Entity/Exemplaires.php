<?php

namespace App\Entity;

use App\Repository\ExemplairesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExemplairesRepository::class)]
class Exemplaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'exemplaires', cascade: ['persist', 'remove'])]
    private ?User $id_utilisateur = null;

    #[ORM\OneToOne(inversedBy: 'exemplaires', cascade: ['persist', 'remove'])]
    private ?Livres $id_livre = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $etat = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $statut = [];

    #[ORM\OneToOne(mappedBy: 'id_exemplaire', cascade: ['persist', 'remove'])]
    private ?Livres $livres = null;

    #[ORM\OneToOne(mappedBy: 'id_exemplaire', cascade: ['persist', 'remove'])]
    private ?Emprunt $emprunt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?User
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?User $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdLivre(): ?Livres
    {
        return $this->id_livre;
    }

    public function setIdLivre(?Livres $id_livre): static
    {
        $this->id_livre = $id_livre;

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

    public function getStatut(): array
    {
        return $this->statut;
    }

    public function setStatut(array $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getLivres(): ?Livres
    {
        return $this->livres;
    }

    public function setLivres(?Livres $livres): static
    {
        // unset the owning side of the relation if necessary
        if ($livres === null && $this->livres !== null) {
            $this->livres->setIdExemplaire(null);
        }

        // set the owning side of the relation if necessary
        if ($livres !== null && $livres->getIdExemplaire() !== $this) {
            $livres->setIdExemplaire($this);
        }

        $this->livres = $livres;

        return $this;
    }

    public function getEmprunt(): ?Emprunt
    {
        return $this->emprunt;
    }

    public function setEmprunt(?Emprunt $emprunt): static
    {
        // unset the owning side of the relation if necessary
        if ($emprunt === null && $this->emprunt !== null) {
            $this->emprunt->setIdExemplaire(null);
        }

        // set the owning side of the relation if necessary
        if ($emprunt !== null && $emprunt->getIdExemplaire() !== $this) {
            $emprunt->setIdExemplaire($this);
        }

        $this->emprunt = $emprunt;

        return $this;
    }
}
