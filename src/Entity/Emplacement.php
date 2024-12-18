<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ranger = null;

    #[ORM\Column(length: 255)]
    private ?string $colonne = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToOne(mappedBy: 'emplacementId', cascade: ['persist', 'remove'])]
    private ?Exemplaire $exemplaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRanger(): ?string
    {
        return $this->ranger;
    }

    public function setRanger(string $ranger): static
    {
        $this->ranger = $ranger;

        return $this;
    }

    public function getColonne(): ?string
    {
        return $this->colonne;
    }

    public function setColonne(string $colonne): static
    {
        $this->colonne = $colonne;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
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

    public function getExemplaire(): ?Exemplaire
    {
        return $this->exemplaire;
    }

    public function setExemplaire(?Exemplaire $exemplaire): static
    {
        // unset the owning side of the relation if necessary
        if ($exemplaire === null && $this->exemplaire !== null) {
            $this->exemplaire->setEmplacementId(null);
        }

        // set the owning side of the relation if necessary
        if ($exemplaire !== null && $exemplaire->getEmplacementId() !== $this) {
            $exemplaire->setEmplacementId($this);
        }

        $this->exemplaire = $exemplaire;

        return $this;
    }
}
