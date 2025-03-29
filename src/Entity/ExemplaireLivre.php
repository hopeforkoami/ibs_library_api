<?php

namespace App\Entity;

use App\Repository\ExemplaireLivreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExemplaireLivreRepository::class)]
class ExemplaireLivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exemplaireLivres')]
    #[Groups(['exemplaire_livre:read'])]
    private ?Livre $livre = null;

    #[ORM\ManyToOne(inversedBy: 'exemplaireLivres')]
    #[Groups(['exemplaire_livre:read', 'livre:details'])]
    private ?Position $position = null;

    #[ORM\Column]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details'])]
    private ?int $numero = null;

    #[ORM\Column]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details'])]
    private ?bool $libre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details'])]
    private ?\DateTimeInterface $dateDisponible = null;

    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details'])]
    private $qrValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): static
    {
        $this->position = $position;

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

    public function setDateDisponible(\DateTimeInterface $dateDisponible): static
    {
        $this->dateDisponible = $dateDisponible;

        return $this;
    }
    public function getQrValue()
    {
        return $this->qrValue;
    }
    public function setQrValue($qrValue)
    {
        $this->qrValue = $qrValue;

        return $this;
    }
}
