<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProducteurRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class Producteur
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'La description du producteur doit faire au moins {{ limit }} caractères.',
        maxMessage: 'La description du producteur doit faire moins de {{ limit }} caractères.'
    )]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'producteur', targetEntity: Produit::class, cascade: ["remove", "persist","refresh"])]
    private Collection $produits;

    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'producteurs')]
    private Collection $marchesProducteurs;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $utilisateur = null;

    public function __toString(): string
    {
        return $this->utilisateur->getNom()." ".$this->utilisateur->getPrenom();
    }

    public function __construct()
    {
        // parent::__construct();
        $this->produits = new ArrayCollection();
        $this->marchesProducteurs = new ArrayCollection();
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
        return $this->marchesProducteurs;
    }

    public function addMarche(Marche $march): static
    {
        if (!$this->marchesProducteurs->contains($march)) {
            $this->marchesProducteurs->add($march);
            $march->addProducteur($this);
        }

        return $this;
    }

    public function removeMarche(Marche $march): static
    {
        if ($this->marchesProducteurs->removeElement($march)) {
            $march->removeProducteur($this);
        }

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
