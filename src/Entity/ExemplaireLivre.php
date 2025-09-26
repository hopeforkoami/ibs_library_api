<?php

namespace App\Entity;

use App\Repository\ExemplaireLivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExemplaireLivreRepository::class)]
class ExemplaireLivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:favoris','exemplaire_livre:read','livre:read', 'livre:details','reservation:read','reservation:details'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exemplaireLivres')]
    #[Groups(['user:favoris','exemplaire_livre:read','reservation:read','reservation:read','reservation:details'])]
    private ?Livre $livre = null;

    #[ORM\ManyToOne(inversedBy: 'exemplaireLivres')]
    #[Groups(['exemplaire_livre:read', 'livre:details','reservation:read'])]
    private ?Position $position = null;

    #[ORM\Column]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details','reservation:read'])]
    private ?int $numero = null;

    #[ORM\Column]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details','reservation:read','reservation:details'])]
    private ?bool $libre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details','reservation:read'])]
    private ?\DateTimeInterface $dateDisponible = null;

    #[Groups(['exemplaire_livre:read','livre:read', 'livre:details','reservation:read','reservation:details'])]
    private $qrValue = null;

    #[ORM\OneToMany(mappedBy: 'exemplaire', targetEntity: Favoris::class)]
    private Collection $favoris;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): static
    {
        $this->position = $position;

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

    public function isLibre(): ?bool
    {
        return $this->libre;
    }

    public function setLibre(bool $libre): static
    {
        $this->libre = $libre;

        return $this;
    }

    public function getDateDisponible(): ?\DateTimeInterface
    {
        return $this->dateDisponible;
    }

    public function setDateDisponible(\DateTimeInterface $dateDisponible): static
    {
        $this->dateDisponible = $dateDisponible;

        return $this;
    }
    public function getQrValue()
    {
        return $this->qrValue;
    }
    public function setQrValue($qrValue)
    {
        $this->qrValue = $qrValue;

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setExemplaire($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getExemplaire() === $this) {
                $favori->setExemplaire(null);
            }
        }

        return $this;
    }
}
