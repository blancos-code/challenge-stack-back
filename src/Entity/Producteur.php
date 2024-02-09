<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProducteurRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class Producteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read", "write"])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'La description du producteur doit faire au moins {{ limit }} caractères.',
        maxMessage: 'La description du producteur doit faire moins de {{ limit }} caractères.'
    )]
    #[Groups(["read", "write"])]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'producteurs')]
    private Collection $marchesProducteurs;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(["read", "write"])]
    private ?User $utilisateur = null;

    #[ORM\Column]
    #[Groups(["read", "write"])]
    private ?float $note = 0;

    #[ORM\OneToMany(mappedBy: 'producteur', targetEntity: CommentaireProducteur::class)]
    #[Groups(["read", "write"])]
    private Collection $commentaireProducteurs;

    #[ORM\OneToMany(mappedBy: 'producteur', targetEntity: PrixProduits::class, fetch:"EAGER", cascade: ['all', 'remove'])]
    #[Groups(["read", "write"])]
    private Collection $prixProduits;

    #[ORM\OneToMany(mappedBy: 'producteur', targetEntity: PrixProduits::class,cascade: ['all', 'remove','persist'])]
    #[Groups(["read", "write"])]
    private Collection $prixProduit;

    public function __toString(): string
    {
        return $this->utilisateur->getNom()." ".$this->utilisateur->getPrenom();
    }

    public function __construct()
    {
        // parent::__construct();
        $this->marchesProducteurs = new ArrayCollection();
        $this->prixProduits = new ArrayCollection();
        $this->prixProduit = new ArrayCollection();
        $this->commentaireProducteurs = new ArrayCollection();
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

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): static
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return Collection<int, PrixProduits>
     */
    public function getPrixProduits(): Collection
    {
        return $this->prixProduits;
    }

    public function addPrixProduits(PrixProduits $prix): static
    {
        if (!$this->prixProduits->contains($prix)) {
            $this->prixProduits->add($prix);
            // $march->addProducteur($this);
        }

        return $this;
    }

    public function removePrixProduits(PrixProduits $prix): static
    {
        if ($this->prixProduits->removeElement($prix)) {
            // $march->removeProducteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PrixProduits>
     */
    public function getPrixProduit(): Collection
    {
        return $this->prixProduit;
    }

    public function addPrixProduit(PrixProduits $prixProduit): static
    {
        if (!$this->prixProduit->contains($prixProduit)) {
            $this->prixProduit->add($prixProduit);
            $prixProduit->setProducteur($this);
        }

        return $this;
    }

    public function removePrixProduit(PrixProduits $prixProduit): static
    {
        if ($this->prixProduit->removeElement($prixProduit)) {
            // set the owning side to null (unless already changed)
            if ($prixProduit->getProducteur() === $this) {
                $prixProduit->setProducteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommentaireProducteur>
     */
    public function getCommentaireProducteurs(): Collection
    {
        return $this->commentaireProducteurs;
    }

    public function addCommentaireProducteur(CommentaireProducteur $commentaireProducteur): static
    {
        if (!$this->commentaireProducteurs->contains($commentaireProducteur)) {
            $this->commentaireProducteurs->add($commentaireProducteur);
            $commentaireProducteur->setProducteur($this);
        }
        $this->calculerMoyenneDesNotes();
        return $this;
    }

    public function removeCommentaireProducteur(CommentaireProducteur $commentaireProducteur): static
    {
        if ($this->commentaireProducteurs->removeElement($commentaireProducteur)) {
            // set the owning side to null (unless already changed)
            if ($commentaireProducteur->getProducteur() === $this) {
                $commentaireProducteur->setProducteur(null);
            }
        }

        return $this;
    }

    public function calculerMoyenneDesNotes(): float
    {
        $totalNotes = 0;
        $nombreDeCommentaires = count($this->commentaireProducteurs);

        if ($nombreDeCommentaires > 0) {
            foreach ($this->commentaireProducteurs as $commentaireProducteur) {
                $totalNotes += $commentaireProducteur->getNote();
            }
            $this->note = $totalNotes / $nombreDeCommentaires;
        }
        return $this->note;
    }
}
