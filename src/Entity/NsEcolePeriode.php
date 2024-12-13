<?php

namespace App\Entity;

use App\Repository\NsEcolePeriodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsEcolePeriodeRepository::class)]
class NsEcolePeriode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'periode', targetEntity: NsEpreuve::class)]
    private Collection $nsEpreuves;

    public function __construct()
    {
        $this->nsEpreuves = new ArrayCollection();
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, NsEpreuve>
     */
    public function getNsEpreuves(): Collection
    {
        return $this->nsEpreuves;
    }

    public function addNsEpreufe(NsEpreuve $nsEpreufe): static
    {
        if (!$this->nsEpreuves->contains($nsEpreufe)) {
            $this->nsEpreuves->add($nsEpreufe);
            $nsEpreufe->setPeriode($this);
        }

        return $this;
    }

    public function removeNsEpreufe(NsEpreuve $nsEpreufe): static
    {
        if ($this->nsEpreuves->removeElement($nsEpreufe)) {
            // set the owning side to null (unless already changed)
            if ($nsEpreufe->getPeriode() === $this) {
                $nsEpreufe->setPeriode(null);
            }
        }

        return $this;
    }
}
