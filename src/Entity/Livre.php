<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $auteurId = null;

    #[ORM\Column]
    private ?int $nbrePages = null;

    #[ORM\Column]
    private ?int $nbreExemplaires = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Langue $langueId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SousCategorie $sousCategorieId = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tags = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $themes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resume = null;

    #[ORM\Column(length: 255)]
    private ?string $edition = null;

    #[ORM\OneToMany(mappedBy: 'livreId', targetEntity: Chapitre::class)]
    private Collection $chapitres;

    #[ORM\OneToMany(mappedBy: 'livreId', targetEntity: Exemplaire::class)]
    private Collection $exemplaires;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
        $this->exemplaires = new ArrayCollection();
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

    public function getAuteurId(): ?Auteur
    {
        return $this->auteurId;
    }

    public function setAuteurId(?Auteur $auteurId): static
    {
        $this->auteurId = $auteurId;

        return $this;
    }

    public function getNbrePages(): ?int
    {
        return $this->nbrePages;
    }

    public function setNbrePages(int $nbrePages): static
    {
        $this->nbrePages = $nbrePages;

        return $this;
    }

    public function getNbreExemplaires(): ?int
    {
        return $this->nbreExemplaires;
    }

    public function setNbreExemplaires(int $nbreExemplaires): static
    {
        $this->nbreExemplaires = $nbreExemplaires;

        return $this;
    }

    public function getLangueId(): ?Langue
    {
        return $this->langueId;
    }

    public function setLangueId(?Langue $langueId): static
    {
        $this->langueId = $langueId;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSousCategorieId(): ?SousCategorie
    {
        return $this->sousCategorieId;
    }

    public function setSousCategorieId(?SousCategorie $sousCategorieId): static
    {
        $this->sousCategorieId = $sousCategorieId;

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

    public function getThemes(): ?string
    {
        return $this->themes;
    }

    public function setThemes(?string $themes): static
    {
        $this->themes = $themes;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): static
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * @return Collection<int, Chapitre>
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): static
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres->add($chapitre);
            $chapitre->setLivreId($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): static
    {
        if ($this->chapitres->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getLivreId() === $this) {
                $chapitre->setLivreId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exemplaire>
     */
    public function getExemplaires(): Collection
    {
        return $this->exemplaires;
    }

    public function addExemplaire(Exemplaire $exemplaire): static
    {
        if (!$this->exemplaires->contains($exemplaire)) {
            $this->exemplaires->add($exemplaire);
            $exemplaire->setLivreId($this);
        }

        return $this;
    }

    public function removeExemplaire(Exemplaire $exemplaire): static
    {
        if ($this->exemplaires->removeElement($exemplaire)) {
            // set the owning side to null (unless already changed)
            if ($exemplaire->getLivreId() === $this) {
                $exemplaire->setLivreId(null);
            }
        }

        return $this;
    }
}