<?php

namespace App\Domain\Rendus;

use App\Domain\Emprunt\Emprunt;
use App\Domain\Rendus\Repository\RendusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendusRepository::class)]
class Rendus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'rendus', cascade: ['persist', 'remove'])]
    private ?Emprunt $id_emprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRendu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEmprunt(): ?Emprunt
    {
        return $this->id_emprunt;
    }

    public function setIdEmprunt(?Emprunt $id_emprunt): static
    {
        $this->id_emprunt = $id_emprunt;

        return $this;
    }

    public function getDateRendu(): ?\DateTimeInterface
    {
        return $this->dateRendu;
    }

    public function setDateRendu(\DateTimeInterface $dateRendu): static
    {
        $this->dateRendu = $dateRendu;

        return $this;
    }
}
