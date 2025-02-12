<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionRepository::class)]
class Position
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'positions')]
    private ?Ranger $ranger = null;

    #[ORM\ManyToOne(inversedBy: 'numero')]
    private ?Colonne $colonne = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'position', targetEntity: ExemplaireLivre::class)]
    private Collection $exemplaireLivres;

    public function __construct()
    {
        $this->exemplaireLivres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRanger(): ?Ranger
    {
        return $this->ranger;
    }

    public function setRanger(?Ranger $ranger): static
    {
        $this->ranger = $ranger;

        return $this;
    }

    public function getColonne(): ?Colonne
    {
        return $this->colonne;
    }

    public function setColonne(?Colonne $colonne): static
    {
        $this->colonne = $colonne;

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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, ExemplaireLivre>
     */
    public function getExemplaireLivres(): Collection
    {
        return $this->exemplaireLivres;
    }

    public function addExemplaireLivre(ExemplaireLivre $exemplaireLivre): static
    {
        if (!$this->exemplaireLivres->contains($exemplaireLivre)) {
            $this->exemplaireLivres->add($exemplaireLivre);
            $exemplaireLivre->setPosition($this);
        }

        return $this;
    }

    public function removeExemplaireLivre(ExemplaireLivre $exemplaireLivre): static
    {
        if ($this->exemplaireLivres->removeElement($exemplaireLivre)) {
            // set the owning side to null (unless already changed)
            if ($exemplaireLivre->getPosition() === $this) {
                $exemplaireLivre->setPosition(null);
            }
        }

        return $this;
    }
}
