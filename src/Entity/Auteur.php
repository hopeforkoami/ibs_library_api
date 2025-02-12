<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['auteur:read', 'livre:read','livresimple:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['auteur:read', 'livre:read','livresimple:read'])]
    private ?string $nomComplet = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['auteur:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['auteur:read'])]
    private ?int $nbreLivres = null;

    #[ORM\OneToMany(mappedBy: 'auteurId', targetEntity: Livre::class)]
    private Collection $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): static
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNbreLivres(): ?int
    {
        return $this->nbreLivres;
    }

    public function setNbreLivres(int $nbreLivres): static
    {
        $this->nbreLivres = $nbreLivres;

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->setAuteurId($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getAuteurId() === $this) {
                $livre->setAuteurId(null);
            }
        }

        return $this;
    }
}
