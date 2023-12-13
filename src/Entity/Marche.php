<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarcheRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class Marche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\ManyToMany(targetEntity: Producteur::class, inversedBy: 'marches')]
    private Collection $producteurs;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'marches')]
    private Collection $clientsInscrits;

    #[ORM\ManyToOne(inversedBy: 'marches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $proprietaire = null;

    #[ORM\ManyToOne(inversedBy: 'marches')]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->producteurs = new ArrayCollection();
        $this->clientsInscrits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeImmutable $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeImmutable $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Producteur>
     */
    public function getProducteurs(): Collection
    {
        return $this->producteurs;
    }

    public function addProducteur(Producteur $producteur): static
    {
        if (!$this->producteurs->contains($producteur)) {
            $this->producteurs->add($producteur);
        }

        return $this;
    }

    public function removeProducteur(Producteur $producteur): static
    {
        $this->producteurs->removeElement($producteur);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getClientsInscrits(): Collection
    {
        return $this->clientsInscrits;
    }

    public function addClientsInscrit(User $clientsInscrit): static
    {
        if (!$this->clientsInscrits->contains($clientsInscrit)) {
            $this->clientsInscrits->add($clientsInscrit);
        }

        return $this;
    }

    public function removeClientsInscrit(User $clientsInscrit): static
    {
        $this->clientsInscrits->removeElement($clientsInscrit);

        return $this;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): static
    {
        $this->proprietaire = $proprietaire;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
