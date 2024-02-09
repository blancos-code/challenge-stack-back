<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentaireMarcheRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentaireMarcheRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class CommentaireMarche
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

    #[ORM\ManyToOne(inversedBy: 'commentaireMarches',cascade: ["persist"])]
    #[Groups(["read", "write"])]
    private ?Marche $marche = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireMarches',cascade: ["persist"])]
    #[Groups(["read", "write"])]
    private ?User $redacteur = null;

    public function __toString(): string
    {
        return $this->titre.' : '.$this->redacteur;
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

    public function getMarche(): ?Marche
    {
        return $this->marche;
    }

    public function setMarche(?Marche $marche): static
    {
        $this->marche = $marche;

        $marche->calculerMoyenneDesNotes();

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
