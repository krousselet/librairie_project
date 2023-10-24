<?php

namespace App\Domain;

use App\Domain\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[assert\NotBlank(message: "Ce champs ne peut pas être vide")]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    // #[assert\NotBlank(message: "Ce champs ne peut pas être vide")]
    // #[assert\Length(
    //     min: 6,
    //     minMessage: "Ce champs doit contenir au minimum {{limit}} caractères",
    //     max: 255,
    //     maxMessage: "Ce champs doit contenir au maximum {{limit}} caractères"
    // )]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[assert\NotBlank(message: "Ce champs ne peut pas être vide")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[assert\NotBlank(message: "Ce champs ne peut pas être vide")]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[assert\NotBlank(message: "Ce champs ne peut pas être vide")]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[assert\NotBlank(message: "Ce champs ne peut pas être vide")]
    private ?string $address = null;

    #[ORM\OneToOne(mappedBy: 'id_utilisateur', cascade: ['persist', 'remove'])]
    private ?Exemplaires $exemplaires = null;

    #[ORM\OneToOne(mappedBy: 'id_utilisateur', cascade: ['persist', 'remove'])]
    private ?Avis $avis = null;

    #[ORM\OneToOne(mappedBy: 'id_utilisateur', cascade: ['persist', 'remove'])]
    private ?Notifications $notifications = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Emprunt::class)]
    private Collection $emprunts;

    #[ORM\OneToOne(mappedBy: 'userEmpruntId', cascade: ['persist', 'remove'])]
    private ?Emprunt $emprunt = null;

    public function __construct()
    {
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getExemplaires(): ?Exemplaires
    {
        return $this->exemplaires;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(?Avis $avis): static
    {
        // unset the owning side of the relation if necessary
        if ($avis === null && $this->avis !== null) {
            $this->avis->setIdUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($avis !== null && $avis->getIdUtilisateur() !== $this) {
            $avis->setIdUtilisateur($this);
        }

        $this->avis = $avis;

        return $this;
    }

    public function getNotifications(): ?Notifications
    {
        return $this->notifications;
    }

    public function setNotifications(?Notifications $notifications): static
    {
        // unset the owning side of the relation if necessary
        if ($notifications === null && $this->notifications !== null) {
            $this->notifications->setIdUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($notifications !== null && $notifications->getIdUtilisateur() !== $this) {
            $notifications->setIdUtilisateur($this);
        }

        $this->notifications = $notifications;

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
            $emprunt->setUser($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getUser() === $this) {
                $emprunt->setUser(null);
            }
        }

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
            $this->emprunt->setUserEmpruntId(null);
        }

        // set the owning side of the relation if necessary
        if ($emprunt !== null && $emprunt->getUserEmpruntId() !== $this) {
            $emprunt->setUserEmpruntId($this);
        }

        $this->emprunt = $emprunt;

        return $this;
    }
}
