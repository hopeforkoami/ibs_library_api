<?php

namespace App\Entity;

use App\Repository\NsClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsClasseRepository::class)]
class NsClasse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'nsClasses')]
    private ?NsProgramme $programme = null;

    #[ORM\ManyToOne(inversedBy: 'nsClasses')]
    private ?NsSerie $serie = null;

    #[ORM\ManyToOne(inversedBy: 'nsClasses')]
    private ?NsNiveau $niveau = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $displayName = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: NsCoursUe::class)]
    private Collection $nsCoursUes;

    public function __construct()
    {
        $this->nsCoursUes = new ArrayCollection();
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

    public function getProgramme(): ?NsProgramme
    {
        return $this->programme;
    }

    public function setProgramme(?NsProgramme $programme): static
    {
        $this->programme = $programme;

        return $this;
    }

    public function getSerie(): ?NsSerie
    {
        return $this->serie;
    }

    public function setSerie(?NsSerie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getNiveau(): ?NsNiveau
    {
        return $this->niveau;
    }

    public function setNiveau(?NsNiveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName): static
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return Collection<int, NsCoursUe>
     */
    public function getNsCoursUes(): Collection
    {
        return $this->nsCoursUes;
    }

    public function addNsCoursUe(NsCoursUe $nsCoursUe): static
    {
        if (!$this->nsCoursUes->contains($nsCoursUe)) {
            $this->nsCoursUes->add($nsCoursUe);
            $nsCoursUe->setClasse($this);
        }

        return $this;
    }

    public function removeNsCoursUe(NsCoursUe $nsCoursUe): static
    {
        if ($this->nsCoursUes->removeElement($nsCoursUe)) {
            // set the owning side to null (unless already changed)
            if ($nsCoursUe->getClasse() === $this) {
                $nsCoursUe->setClasse(null);
            }
        }

        return $this;
    }
}
