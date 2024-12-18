<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Reservation $reservation = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    private ?StatusEmprunt $statusEmpruntId = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    private ?Exemplaire $exemplaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebutEmprunt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFinEmpruntPrevu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFinEmprunt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePrevuRappel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getStatusEmpruntId(): ?StatusEmprunt
    {
        return $this->statusEmpruntId;
    }

    public function setStatusEmpruntId(?StatusEmprunt $statusEmpruntId): static
    {
        $this->statusEmpruntId = $statusEmpruntId;

        return $this;
    }

    public function getExemplaire(): ?Exemplaire
    {
        return $this->exemplaire;
    }

    public function setExemplaire(?Exemplaire $exemplaire): static
    {
        $this->exemplaire = $exemplaire;

        return $this;
    }

    public function getDateDebutEmprunt(): ?\DateTimeInterface
    {
        return $this->dateDebutEmprunt;
    }

    public function setDateDebutEmprunt(\DateTimeInterface $dateDebutEmprunt): static
    {
        $this->dateDebutEmprunt = $dateDebutEmprunt;

        return $this;
    }

    public function getDateFinEmpruntPrevu(): ?\DateTimeInterface
    {
        return $this->dateFinEmpruntPrevu;
    }

    public function setDateFinEmpruntPrevu(\DateTimeInterface $dateFinEmpruntPrevu): static
    {
        $this->dateFinEmpruntPrevu = $dateFinEmpruntPrevu;

        return $this;
    }

    public function getDateFinEmprunt(): ?\DateTimeInterface
    {
        return $this->dateFinEmprunt;
    }

    public function setDateFinEmprunt(?\DateTimeInterface $dateFinEmprunt): static
    {
        $this->dateFinEmprunt = $dateFinEmprunt;

        return $this;
    }

    public function getDatePrevuRappel(): ?\DateTimeInterface
    {
        return $this->datePrevuRappel;
    }

    public function setDatePrevuRappel(\DateTimeInterface $datePrevuRappel): static
    {
        $this->datePrevuRappel = $datePrevuRappel;

        return $this;
    }
}
