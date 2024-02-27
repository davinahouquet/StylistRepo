<?php

namespace App\Entity;

use App\Repository\RoutineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoutineRepository::class)]
class Routine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_routine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_routine = null;

    #[ORM\Column]
    private ?float $prix_routine = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_routine = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'routines')]
    private Collection $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRoutine(): ?string
    {
        return $this->nom_routine;
    }

    public function setNomRoutine(string $nom_routine): static
    {
        $this->nom_routine = $nom_routine;

        return $this;
    }

    public function getImageRoutine(): ?string
    {
        return $this->image_routine;
    }

    public function setImageRoutine(?string $image_routine): static
    {
        $this->image_routine = $image_routine;

        return $this;
    }

    public function getPrixRoutine(): ?float
    {
        return $this->prix_routine;
    }

    public function setPrixRoutine(float $prix_routine): static
    {
        $this->prix_routine = $prix_routine;

        return $this;
    }

    public function getDescriptionRoutine(): ?string
    {
        return $this->description_routine;
    }

    public function setDescriptionRoutine(string $description_routine): static
    {
        $this->description_routine = $description_routine;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->produit->removeElement($produit);

        return $this;
    }
}
