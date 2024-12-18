<?php

namespace App\Entity;

use App\Repository\ExemplaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExemplaireRepository::class)]
class Exemplaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exemplaires')]
    private ?Livre $livreId = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\OneToOne(inversedBy: 'exemplaire', cascade: ['persist', 'remove'])]
    private ?Emplacement $emplacementId = null;

    #[ORM\Column]
    private ?bool $libre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDisponible = null;

    #[ORM\ManyToMany(targetEntity: Reservation::class, mappedBy: 'exemplaireId')]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'exemplaire', targetEntity: Emprunt::class)]
    private Collection $emprunts;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivreId(): ?Livre
    {
        return $this->livreId;
    }

    public function setLivreId(?Livre $livreId): static
    {
        $this->livreId = $livreId;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEmplacementId(): ?Emplacement
    {
        return $this->emplacementId;
    }

    public function setEmplacementId(?Emplacement $emplacementId): static
    {
        $this->emplacementId = $emplacementId;

        return $this;
    }

    public function isLibre(): ?bool
    {
        return $this->libre;
    }

    public function setLibre(bool $libre): static
    {
        $this->libre = $libre;

        return $this;
    }

    public function getDateDisponible(): ?\DateTimeInterface
    {
        return $this->dateDisponible;
    }

    public function setDateDisponible(?\DateTimeInterface $dateDisponible): static
    {
        $this->dateDisponible = $dateDisponible;

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
            $reservation->addExemplaireId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removeExemplaireId($this);
        }

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
            $emprunt->setExemplaire($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getExemplaire() === $this) {
                $emprunt->setExemplaire(null);
            }
        }

        return $this;
    }
}
