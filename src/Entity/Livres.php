<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Exemplaires;

#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $editeur = null;

    #[ORM\Column(length: 13)]
    private ?string $isbn = null;

    #[ORM\OneToOne(mappedBy: 'id_livre', cascade: ['persist', 'remove'])]
    private ?Exemplaires $exemplaires = null;

    #[ORM\OneToOne(inversedBy: 'livres', cascade: ['persist', 'remove'])]
    private ?Exemplaires $id_exemplaire = null;

    #[ORM\ManyToOne(inversedBy: 'id_livre')]
    private ?Avis $avis = null;

    #[ORM\OneToOne(mappedBy: 'id_livre', cascade: ['persist', 'remove'])]
    private ?Categories $categories = null;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Emprunt::class)]
    private Collection $emprunts;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function __construct()
    {
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getEditeur(): ?array
    {
        return $this->editeur;
    }

    public function setEditeur(?array $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }


    public function getExemplaires(): ?Exemplaires
    {
        return $this->exemplaires;
    }

    // public function setExemplaires(?Exemplaires $exemplaires): static
    // {
    //     // unset the owning side of the relation if necessary
    //     if ($exemplaires === null && $this->exemplaires !== null) {
    //         $this->exemplaires->setIdLivre(null);
    //     }

    //     // set the owning side of the relation if necessary
    //     if ($exemplaires !== null && $exemplaires->getIdLivre() !== $this) {
    //         $exemplaires->setIdLivre($this);
    //     }

    //     $this->exemplaires = $exemplaires;

    //     return $this;
    // }

    public function getIdExemplaire(): ?Exemplaires
    {
        return $this->id_exemplaire;
    }

    public function setIdExemplaire(?Exemplaires $id_exemplaire): static
    {
        $this->id_exemplaire = $id_exemplaire;

        return $this;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(?Avis $avis): static
    {
        $this->avis = $avis;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): static
    {
        // unset the owning side of the relation if necessary
        if ($categories === null && $this->categories !== null) {
            $this->categories->setIdLivre(null);
        }

        // set the owning side of the relation if necessary
        if ($categories !== null && $categories->getIdLivre() !== $this) {
            $categories->setIdLivre($this);
        }

        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): static
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts->add($emprunt);
            $emprunt->setLivre($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getLivre() === $this) {
                $emprunt->setLivre(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
