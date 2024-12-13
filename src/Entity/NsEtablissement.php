<?php

namespace App\Entity;

use App\Repository\NsEtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsEtablissementRepository::class)]
class NsEtablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteWeb = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gps = null;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: NsEpreuve::class)]
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?string $siteWeb): static
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getGps(): ?string
    {
        return $this->gps;
    }

    public function setGps(?string $gps): static
    {
        $this->gps = $gps;

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
            $nsEpreufe->setEtablissement($this);
        }

        return $this;
    }

    public function removeNsEpreufe(NsEpreuve $nsEpreufe): static
    {
        if ($this->nsEpreuves->removeElement($nsEpreufe)) {
            // set the owning side to null (unless already changed)
            if ($nsEpreufe->getEtablissement() === $this) {
                $nsEpreufe->setEtablissement(null);
            }
        }

        return $this;
    }
}
