<?php

namespace App\Domain\Categories;

use App\Domain\Categories\Repository\CategoriesRepository;
use App\Domain\Livres\Livres;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'categories', cascade: ['persist', 'remove'])]
    private ?Livres $id_livre = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCategorie = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }
}
