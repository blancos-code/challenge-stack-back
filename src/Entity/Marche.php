<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: MarcheRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class Marche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'L\'adresse du marché doit faire au moins {{ limit }} caractères.',
        maxMessage: 'L\'adresse du marché doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'L\'adresse du marché ne peut pas être vide'
    )]
    #[Groups(["read", "write"])]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Assert\NotBlank(
        message: 'La date du marché ne peut pas être vide'
    )]
    #[Groups(["read", "write"])]
    private ?\DateTimeImmutable $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Assert\NotBlank(
        message: 'L\'heure du marché ne peut pas être vide'
    )]
    #[Groups(["read", "write"])]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\ManyToMany(targetEntity: Producteur::class, inversedBy: 'marchesProducteurs')]
    // TODO : repasser pour vérifier si nécessaire
    // #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $producteurs;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'marchesInscrits')]
    private Collection $clientsInscrits;

    #[ORM\ManyToOne(inversedBy: 'marchesProprietaire')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $proprietaire = null;

    #[ORM\ManyToOne(inversedBy: 'marches')]
    #[Groups(["read", "write"])]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le nom du marché doit faire au moins {{ limit }} caractères.',
        maxMessage: 'Le nom du marché doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'Le nom du marché ne peut pas être vide'
    )]
    #[Groups(["read", "write"])]
    private ?string $nom = null;

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context)
    {
        // Mettez votre logique de validation ici
        if ($this->dateDebut > $this->dateFin) {
            $context->buildViolation('Dates invalides')
                ->atPath('dateFin')
                ->addViolation();
        }
    }

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
