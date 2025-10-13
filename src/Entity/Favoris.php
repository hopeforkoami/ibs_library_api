<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:favoris'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    #[Groups(['user:favoris'])]
    private ?ExemplaireLivre $exemplaire = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    private ?Membre $membre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExemplaire(): ?ExemplaireLivre
    {
        return $this->exemplaire;
    }

    public function setExemplaire(?ExemplaireLivre $exemplaire): static
    {
        $this->exemplaire = $exemplaire;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
