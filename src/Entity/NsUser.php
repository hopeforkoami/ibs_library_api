<?php

namespace App\Entity;

use App\Repository\NsUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsUserRepository::class)]
class NsUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'nsUsers')]
    private ?NsDroit $droit = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: NsAuthorisation::class)]
    private Collection $nsAuthorisations;

    public function __construct()
    {
        $this->nsAuthorisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getDroit(): ?NsDroit
    {
        return $this->droit;
    }

    public function setDroit(?NsDroit $droit): static
    {
        $this->droit = $droit;

        return $this;
    }

    /**
     * @return Collection<int, NsAuthorisation>
     */
    public function getNsAuthorisations(): Collection
    {
        return $this->nsAuthorisations;
    }

    public function addNsAuthorisation(NsAuthorisation $nsAuthorisation): static
    {
        if (!$this->nsAuthorisations->contains($nsAuthorisation)) {
            $this->nsAuthorisations->add($nsAuthorisation);
            $nsAuthorisation->setUser($this);
        }

        return $this;
    }

    public function removeNsAuthorisation(NsAuthorisation $nsAuthorisation): static
    {
        if ($this->nsAuthorisations->removeElement($nsAuthorisation)) {
            // set the owning side to null (unless already changed)
            if ($nsAuthorisation->getUser() === $this) {
                $nsAuthorisation->setUser(null);
            }
        }

        return $this;
    }
}
