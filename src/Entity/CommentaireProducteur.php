<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentaireProducteurRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentaireProducteurRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class CommentaireProducteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read", "write"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read", "write"])]
    private ?string $titre = null;

    #[ORM\Column]
    #[Groups(["read", "write"])]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read", "write"])]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireProducteurs')]
    #[Groups(["read", "write"])]
    private ?Producteur $producteur = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireProducteurs')]
    #[Groups(["read", "write"])]
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
        dd('test');
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
