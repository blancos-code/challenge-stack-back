<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le nom du produit doit faire au moins {{ limit }} caractères.',
        maxMessage: 'Le nom du produit doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'Le nom du produit ne peut pas être vide'
    )]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[Assert\NotBlank(
        message: 'Le produit doit avoir un producteur'
    )]
    private ?Producteur $producteur = null;

    #[ORM\Column]
    private ?float $prix = null;

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProducteur(): ?Producteur
    {
        return $this->producteur;
    }

    public function setProducteur(?Producteur $producteur): static
    {
        $this->producteur = $producteur;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
