<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([ 'membre:details','reservation:read','reservation:details'])]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: ExemplaireLivre::class, inversedBy: 'reservations')]
    #[Groups(['membre:details','reservation:read','reservation:details'])]
    private Collection $exemplaireId;

    #[ORM\ManyToMany(targetEntity: Livre::class, inversedBy: 'reservations')]
    
    private Collection $livre;

    #[ORM\ManyToOne(targetEntity: Membre::class, inversedBy: 'reservations')]
    #[Groups(['reservation:read','reservation:details'])]
    private ?Membre $membre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['membre:details','reservation:read','reservation:details'])]
    private ?\DateTimeInterface $dateDebutPrevu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['membre:details','reservation:read','reservation:details'])]
    private ?\DateTimeInterface $dateFinPrevu = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Groups(['reservation:read','reservation:details'])]
    private ?StatusReservation $statusReservation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['membre:details','reservation:read','reservation:details'])]
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
     * @return Collection<int, ExemplaireLivre>
     */
    public function getExemplaireId(): Collection
    {
        return $this->exemplaireId;
    }

    public function addExemplaireId(ExemplaireLivre $exemplaireId): static
    {
        if (!$this->exemplaireId->contains($exemplaireId)) {
            $this->exemplaireId->add($exemplaireId);
        }

        return $this;
    }

    public function removeExemplaireId(ExemplaireLivre $exemplaireId): static
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
