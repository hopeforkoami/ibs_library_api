<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['livre:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['livre:read'])]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['livre:read'])]
    private ?Auteur $auteurId = null;

    #[ORM\Column]
    #[Groups(['livre:read'])]
    private ?int $nbrePages = null;

    #[ORM\Column]
    #[Groups(['livre:read'])]
    private ?int $nbreExemplaires = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['livre:read'])]
    private ?Langue $langueId = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['livre:read'])]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['livre:read'])]
    private ?string $isbn = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['livre:read'])]
    private ?SousCategorie $sousCategorieId = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['livre:read'])]
    private ?string $tags = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['livre:read'])]
    private ?string $themes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['livre:read'])]
    private ?string $resume = null;

    #[ORM\Column(length: 255)]
    #[Groups(['livre:read'])]
    private ?string $edition = null;

    #[ORM\OneToMany(mappedBy: 'livreId', targetEntity: Chapitre::class)]
    #[Groups(['livre:read'])]
    private Collection $chapitres;

    #[ORM\OneToMany(mappedBy: 'livreId', targetEntity: Exemplaire::class)]
    #[Groups(['livre:read'])]
    private Collection $exemplaires;

    #[ORM\ManyToMany(targetEntity: Reservation::class, mappedBy: 'livre')]
    #[Groups(['livre:read'])]
    private Collection $reservations;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
        $this->exemplaires = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): static
    {
        $this->isbn = $isbn;

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

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->addLivre($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removeLivre($this);
        }

        return $this;
    }
}
