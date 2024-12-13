<?php

namespace App\Entity;

use App\Repository\NsMatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NsMatiereRepository::class)]
class NsMatiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: NsCoursUe::class)]
    private Collection $nsCoursUes;

    public function __construct()
    {
        $this->nsCoursUes = new ArrayCollection();
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
     * @return Collection<int, NsCoursUe>
     */
    public function getNsCoursUes(): Collection
    {
        return $this->nsCoursUes;
    }

    public function addNsCoursUe(NsCoursUe $nsCoursUe): static
    {
        if (!$this->nsCoursUes->contains($nsCoursUe)) {
            $this->nsCoursUes->add($nsCoursUe);
            $nsCoursUe->setMatiere($this);
        }

        return $this;
    }

    public function removeNsCoursUe(NsCoursUe $nsCoursUe): static
    {
        if ($this->nsCoursUes->removeElement($nsCoursUe)) {
            // set the owning side to null (unless already changed)
            if ($nsCoursUe->getMatiere() === $this) {
                $nsCoursUe->setMatiere(null);
            }
        }

        return $this;
    }
}
