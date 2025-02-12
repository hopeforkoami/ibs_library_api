<?php

namespace App\Entity;

use App\Repository\ColonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColonneRepository::class)]
class Colonne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'colonne', targetEntity: Position::class)]
    private Collection $position;

    public function __construct()
    {
        $this->numero = new ArrayCollection();
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Position>
     */
    public function getPosition(): Collection
    {
        return $this->position;
    }

    public function addPosition(Position $position): static
    {
        if (!$this->position->contains($position)) {
            $this->position->add($position);
            $position->setColonne($this);
        }

        return $this;
    }

    public function removePosition(Position $position): static
    {
        if ($this->position->removeElement($position)) {
            // set the owning side to null (unless already changed)
            if ($position->getColonne() === $this) {
                $position->setColonne(null);
            }
        }

        return $this;
    }
}
