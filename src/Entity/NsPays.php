<?php

namespace App\Entity;

use App\Repository\NsPaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsPaysRepository::class)]
class NsPays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length: 2)]
    private ?string $alpha2 = null;

    #[ORM\Column(length: 3)]
    private ?string $alpha3 = null;

    #[ORM\Column(length: 50)]
    private ?string $nomEnGb = null;

    #[ORM\Column(length: 50)]
    private ?string $nomFrFr = null;

    #[ORM\OneToMany(mappedBy: 'pays', targetEntity: NsProgramme::class)]
    private Collection $nsProgrammes;

    public function __construct()
    {
        $this->nsProgrammes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getAlpha2(): ?string
    {
        return $this->alpha2;
    }

    public function setAlpha2(string $alpha2): static
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    public function getAlpha3(): ?string
    {
        return $this->alpha3;
    }

    public function setAlpha3(string $alpha3): static
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    public function getNomEnGb(): ?string
    {
        return $this->nomEnGb;
    }

    public function setNomEnGb(string $nomEnGb): static
    {
        $this->nomEnGb = $nomEnGb;

        return $this;
    }

    public function getNomFrFr(): ?string
    {
        return $this->nomFrFr;
    }

    public function setNomFrFr(string $nomFrFr): static
    {
        $this->nomFrFr = $nomFrFr;

        return $this;
    }

    /**
     * @return Collection<int, NsProgramme>
     */
    public function getNsProgrammes(): Collection
    {
        return $this->nsProgrammes;
    }

    public function addNsProgramme(NsProgramme $nsProgramme): static
    {
        if (!$this->nsProgrammes->contains($nsProgramme)) {
            $this->nsProgrammes->add($nsProgramme);
            $nsProgramme->setPays($this);
        }

        return $this;
    }

    public function removeNsProgramme(NsProgramme $nsProgramme): static
    {
        if ($this->nsProgrammes->removeElement($nsProgramme)) {
            // set the owning side to null (unless already changed)
            if ($nsProgramme->getPays() === $this) {
                $nsProgramme->setPays(null);
            }
        }

        return $this;
    }
}
