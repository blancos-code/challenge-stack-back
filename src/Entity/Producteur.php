<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProducteurRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class Producteur extends User
{
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'producteur', targetEntity: Produit::class)]
    private Collection $produits;

    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'producteurs')]
    private Collection $marches;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->marches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setProducteur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getProducteur() === $this) {
                $produit->setProducteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Marche>
     */
    public function getMarches(): Collection
    {
        return $this->marches;
    }

    public function addMarche(Marche $march): static
    {
        if (!$this->marches->contains($march)) {
            $this->marches->add($march);
            $march->addProducteur($this);
        }

        return $this;
    }

    public function removeMarch(Marche $march): static
    {
        if ($this->marches->removeElement($march)) {
            $march->removeProducteur($this);
        }

        return $this;
    }
}
