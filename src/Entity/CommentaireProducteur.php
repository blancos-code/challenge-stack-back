<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentaireProducteurRepository;

#[ORM\Entity(repositoryClass: CommentaireProducteurRepository::class)]
class CommentaireProducteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireProducteurs')]
    private ?Producteur $producteur = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireProducteurs')]
    private ?User $redacteur = null;

    public function __toString(): string
    {
        return $this->titre;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

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

    public function getRedacteur(): ?User
    {
        return $this->redacteur;
    }

    public function setRedacteur(?User $redacteur): static
    {
        $this->redacteur = $redacteur;

        return $this;
    }
}
