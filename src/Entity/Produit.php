<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
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

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: PrixProduits::class)]
    private Collection $prixProduits;

    public function __toString(): string
    {
        return $this->nom;
    }

    public function __construct()
    {
        $this->prixProduits = new ArrayCollection();
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

    /**
     * @return Collection<int, PrixProduits>
     */
    public function getPrixProduits(): Collection
    {
        return $this->prixProduits;
    }

    public function addPrixProduit(PrixProduits $prixProduit): static
    {
        if (!$this->prixProduits->contains($prixProduit)) {
            $this->prixProduits->add($prixProduit);
            $prixProduit->setProduit($this);
        }

        return $this;
    }

    public function removePrixProduit(PrixProduits $prixProduit): static
    {
        if ($this->prixProduits->removeElement($prixProduit)) {
            // set the owning side to null (unless already changed)
            if ($prixProduit->getProduit() === $this) {
                $prixProduit->setProduit(null);
            }
        }

        return $this;
    }
}
