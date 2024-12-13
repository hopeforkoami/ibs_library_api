<?php

namespace App\Entity;

use App\Repository\NsChapitreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsChapitreRepository::class)]
class NsChapitre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tags = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $display = null;

    #[ORM\ManyToOne(inversedBy: 'nsChapitres')]
    private ?NsCoursUe $coursUe = null;

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

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getDisplay(): ?string
    {
        return $this->display;
    }

    public function setDisplay(?string $display): static
    {
        $this->display = $display;

        return $this;
    }

    public function getCoursUe(): ?NsCoursUe
    {
        return $this->coursUe;
    }

    public function setCoursUe(?NsCoursUe $coursUe): static
    {
        $this->coursUe = $coursUe;

        return $this;
    }
}
