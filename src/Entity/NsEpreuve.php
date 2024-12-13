<?php

namespace App\Entity;

use App\Repository\NsEpreuveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsEpreuveRepository::class)]
class NsEpreuve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateComposition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255)]
    private ?string $fichier = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenuText = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenuHtml = null;

    #[ORM\ManyToOne(inversedBy: 'nsEpreuves')]
    private ?NsEcolePeriode $periode = null;

    #[ORM\ManyToOne(inversedBy: 'nsEpreuves')]
    private ?NsCoursUe $cours = null;

    #[ORM\ManyToOne(inversedBy: 'nsEpreuves')]
    private ?NsEtablissement $etablissement = null;

    #[ORM\OneToMany(mappedBy: 'epreuve', targetEntity: NsExercice::class)]
    private Collection $nsExercices;

    public function __construct()
    {
        $this->nsExercices = new ArrayCollection();
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

    public function getDateComposition(): ?\DateTimeInterface
    {
        return $this->dateComposition;
    }

    public function setDateComposition(?\DateTimeInterface $dateComposition): static
    {
        $this->dateComposition = $dateComposition;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): static
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getContenuText(): ?string
    {
        return $this->contenuText;
    }

    public function setContenuText(?string $contenuText): static
    {
        $this->contenuText = $contenuText;

        return $this;
    }

    public function getContenuHtml(): ?string
    {
        return $this->contenuHtml;
    }

    public function setContenuHtml(?string $contenuHtml): static
    {
        $this->contenuHtml = $contenuHtml;

        return $this;
    }

    public function getPeriode(): ?NsEcolePeriode
    {
        return $this->periode;
    }

    public function setPeriode(?NsEcolePeriode $periode): static
    {
        $this->periode = $periode;

        return $this;
    }

    public function getCours(): ?NsCoursUe
    {
        return $this->cours;
    }

    public function setCours(?NsCoursUe $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getEtablissement(): ?NsEtablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?NsEtablissement $etablissement): static
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection<int, NsExercice>
     */
    public function getNsExercices(): Collection
    {
        return $this->nsExercices;
    }

    public function addNsExercice(NsExercice $nsExercice): static
    {
        if (!$this->nsExercices->contains($nsExercice)) {
            $this->nsExercices->add($nsExercice);
            $nsExercice->setEpreuve($this);
        }

        return $this;
    }

    public function removeNsExercice(NsExercice $nsExercice): static
    {
        if ($this->nsExercices->removeElement($nsExercice)) {
            // set the owning side to null (unless already changed)
            if ($nsExercice->getEpreuve() === $this) {
                $nsExercice->setEpreuve(null);
            }
        }

        return $this;
    }
}
