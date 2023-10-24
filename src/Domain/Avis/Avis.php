<?php

namespace App\Domain\Avis;

use App\Domain\Avis\Repository\AvisRepository;
use App\Domain\Livre\Livres;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'avis', cascade: ['persist', 'remove'])]
    private ?User $id_utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'avis', targetEntity: Livres::class)]
    private Collection $id_livre;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    public function __construct()
    {
        $this->id_livre = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Livres>
     */
    public function getIdLivre(): Collection
    {
        return $this->id_livre;
    }

    public function addIdLivre(Livres $idLivre): static
    {
        if (!$this->id_livre->contains($idLivre)) {
            $this->id_livre->add($idLivre);
            $idLivre->setAvis($this);
        }

        return $this;
    }

    public function removeIdLivre(Livres $idLivre): static
    {
        if ($this->id_livre->removeElement($idLivre)) {
            // set the owning side to null (unless already changed)
            if ($idLivre->getAvis() === $this) {
                $idLivre->setAvis(null);
            }
        }

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
