<?php

namespace App\Entity;

use App\Repository\NsExerciceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsExerciceRepository::class)]
class NsExercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenuText = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenuHtml = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fichier = null;

    #[ORM\ManyToOne(inversedBy: 'nsExercices')]
    private ?NsEpreuve $epreuve = null;

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

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): static
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getEpreuve(): ?NsEpreuve
    {
        return $this->epreuve;
    }

    public function setEpreuve(?NsEpreuve $epreuve): static
    {
        $this->epreuve = $epreuve;

        return $this;
    }
}
