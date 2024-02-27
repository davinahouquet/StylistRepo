<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_prestation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_prestation = null;

    #[ORM\Column]
    private ?float $prix_prestation = null;

    #[ORM\Column]
    private ?float $duree_prestation = null;

    #[ORM\ManyToOne(inversedBy: 'prestations')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'prestations')]
    private ?Personne $personne = null;

    #[ORM\ManyToMany(targetEntity: Reservation::class, mappedBy: 'prestation')]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPrestation(): ?string
    {
        return $this->nom_prestation;
    }

    public function setNomPrestation(string $nom_prestation): static
    {
        $this->nom_prestation = $nom_prestation;

        return $this;
    }

    public function getDescriptionPrestation(): ?string
    {
        return $this->description_prestation;
    }

    public function setDescriptionPrestation(string $description_prestation): static
    {
        $this->description_prestation = $description_prestation;

        return $this;
    }

    public function getPrixPrestation(): ?float
    {
        return $this->prix_prestation;
    }

    public function setPrixPrestation(float $prix_prestation): static
    {
        $this->prix_prestation = $prix_prestation;

        return $this;
    }

    public function getDureePrestation(): ?float
    {
        return $this->duree_prestation;
    }

    public function setDureePrestation(float $duree_prestation): static
    {
        $this->duree_prestation = $duree_prestation;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): static
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->addPrestation($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removePrestation($this);
        }

        return $this;
    }
}
