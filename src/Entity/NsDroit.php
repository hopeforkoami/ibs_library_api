<?php

namespace App\Entity;

use App\Repository\NsDroitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsDroitRepository::class)]
class NsDroit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'droit', targetEntity: NsUser::class)]
    private Collection $nsUsers;

    public function __construct()
    {
        $this->nsUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, NsUser>
     */
    public function getNsUsers(): Collection
    {
        return $this->nsUsers;
    }

    public function addNsUser(NsUser $nsUser): static
    {
        if (!$this->nsUsers->contains($nsUser)) {
            $this->nsUsers->add($nsUser);
            $nsUser->setDroit($this);
        }

        return $this;
    }

    public function removeNsUser(NsUser $nsUser): static
    {
        if ($this->nsUsers->removeElement($nsUser)) {
            // set the owning side to null (unless already changed)
            if ($nsUser->getDroit() === $this) {
                $nsUser->setDroit(null);
            }
        }

        return $this;
    }
}
