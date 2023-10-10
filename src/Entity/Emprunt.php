<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'emprunt', cascade: ['persist', 'remove'])]
    private ?Exemplaires $id_exemplaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEmprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\OneToOne(mappedBy: 'id_emprunt', cascade: ['persist', 'remove'])]
    private ?Rendus $rendus = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setRendus(?Rendus $rendus): static
    {
        // unset the owning side of the relation if necessary
        if ($rendus === null && $this->rendus !== null) {
            $this->rendus->setIdEmprunt(null);
        }

        // set the owning side of the relation if necessary
        if ($rendus !== null && $rendus->getIdEmprunt() !== $this) {
            $rendus->setIdEmprunt($this);
        }

        $this->rendus = $rendus;

        return $this;
    }
}
