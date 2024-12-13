<?php

namespace App\Entity;

use App\Repository\NsProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsProgrammeRepository::class)]
class NsProgramme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'nsProgrammes')]
    private ?NsPays $pays = null;

    #[ORM\OneToMany(mappedBy: 'programme', targetEntity: NsClasse::class)]
    private Collection $nsClasses;

    public function __construct()
    {
        $this->nsClasses = new ArrayCollection();
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

    public function getPays(): ?NsPays
    {
        return $this->pays;
    }

    public function setPays(?NsPays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, NsClasse>
     */
    public function getNsClasses(): Collection
    {
        return $this->nsClasses;
    }

    public function addNsClass(NsClasse $nsClass): static
    {
        if (!$this->nsClasses->contains($nsClass)) {
            $this->nsClasses->add($nsClass);
            $nsClass->setProgramme($this);
        }

        return $this;
    }

    public function removeNsClass(NsClasse $nsClass): static
    {
        if ($this->nsClasses->removeElement($nsClass)) {
            // set the owning side to null (unless already changed)
            if ($nsClass->getProgramme() === $this) {
                $nsClass->setProgramme(null);
            }
        }

        return $this;
    }
}
