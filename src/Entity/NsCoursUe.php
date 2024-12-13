<?php

namespace App\Entity;

use App\Repository\NsCoursUeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsCoursUeRepository::class)]
class NsCoursUe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tags = null;

    #[ORM\ManyToOne(inversedBy: 'nsCoursUes')]
    private ?NsMatiere $matiere = null;

    #[ORM\ManyToOne(inversedBy: 'nsCoursUes')]
    private ?NsClasse $classe = null;

    #[ORM\Column(length: 255)]
    private ?string $displayName = null;

    #[ORM\OneToMany(mappedBy: 'coursUe', targetEntity: NsChapitre::class)]
    private Collection $nsChapitres;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: NsEpreuve::class)]
    private Collection $nsEpreuves;

    public function __construct()
    {
        $this->nsChapitres = new ArrayCollection();
        $this->nsEpreuves = new ArrayCollection();
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

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getMatiere(): ?NsMatiere
    {
        return $this->matiere;
    }

    public function setMatiere(?NsMatiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getClasse(): ?NsClasse
    {
        return $this->classe;
    }

    public function setClasse(?NsClasse $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): static
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return Collection<int, NsChapitre>
     */
    public function getNsChapitres(): Collection
    {
        return $this->nsChapitres;
    }

    public function addNsChapitre(NsChapitre $nsChapitre): static
    {
        if (!$this->nsChapitres->contains($nsChapitre)) {
            $this->nsChapitres->add($nsChapitre);
            $nsChapitre->setCoursUe($this);
        }

        return $this;
    }

    public function removeNsChapitre(NsChapitre $nsChapitre): static
    {
        if ($this->nsChapitres->removeElement($nsChapitre)) {
            // set the owning side to null (unless already changed)
            if ($nsChapitre->getCoursUe() === $this) {
                $nsChapitre->setCoursUe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NsEpreuve>
     */
    public function getNsEpreuves(): Collection
    {
        return $this->nsEpreuves;
    }

    public function addNsEpreufe(NsEpreuve $nsEpreufe): static
    {
        if (!$this->nsEpreuves->contains($nsEpreufe)) {
            $this->nsEpreuves->add($nsEpreufe);
            $nsEpreufe->setCours($this);
        }

        return $this;
    }

    public function removeNsEpreufe(NsEpreuve $nsEpreufe): static
    {
        if ($this->nsEpreuves->removeElement($nsEpreufe)) {
            // set the owning side to null (unless already changed)
            if ($nsEpreufe->getCours() === $this) {
                $nsEpreufe->setCours(null);
            }
        }

        return $this;
    }
}
