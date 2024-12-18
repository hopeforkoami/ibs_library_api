<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Exemplaire::class, inversedBy: 'reservations')]
    private Collection $exemplaireId;

    #[ORM\ManyToMany(targetEntity: Livre::class, inversedBy: 'reservations')]
    private Collection $livre;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Membre $membre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebutPrevu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFinPrevu = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?StatusReservation $statusReservation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateReservation = null;

    public function __construct()
    {
        $this->exemplaireId = new ArrayCollection();
        $this->livre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Exemplaire>
     */
    public function getExemplaireId(): Collection
    {
        return $this->exemplaireId;
    }

    public function addExemplaireId(Exemplaire $exemplaireId): static
    {
        if (!$this->exemplaireId->contains($exemplaireId)) {
            $this->exemplaireId->add($exemplaireId);
        }

        return $this;
    }

    public function removeExemplaireId(Exemplaire $exemplaireId): static
    {
        $this->exemplaireId->removeElement($exemplaireId);

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivre(): Collection
    {
        return $this->livre;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livre->contains($livre)) {
            $this->livre->add($livre);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        $this->livre->removeElement($livre);

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getDateDebutPrevu(): ?\DateTimeInterface
    {
        return $this->dateDebutPrevu;
    }

    public function setDateDebutPrevu(\DateTimeInterface $dateDebutPrevu): static
    {
        $this->dateDebutPrevu = $dateDebutPrevu;

        return $this;
    }

    public function getDateFinPrevu(): ?\DateTimeInterface
    {
        return $this->dateFinPrevu;
    }

    public function setDateFinPrevu(\DateTimeInterface $dateFinPrevu): static
    {
        $this->dateFinPrevu = $dateFinPrevu;

        return $this;
    }

    public function getStatusReservation(): ?StatusReservation
    {
        return $this->statusReservation;
    }

    public function setStatusReservation(?StatusReservation $statusReservation): static
    {
        $this->statusReservation = $statusReservation;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): static
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }
}
