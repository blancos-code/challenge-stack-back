<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Marche::class)]
    private Collection $marches;

    public function __construct()
    {
        $this->marches = new ArrayCollection();
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
     * @return Collection<int, Marche>
     */
    public function getMarches(): Collection
    {
        return $this->marches;
    }

    public function addMarch(Marche $march): static
    {
        if (!$this->marches->contains($march)) {
            $this->marches->add($march);
            $march->setCategorie($this);
        }

        return $this;
    }

    public function removeMarch(Marche $march): static
    {
        if ($this->marches->removeElement($march)) {
            // set the owning side to null (unless already changed)
            if ($march->getCategorie() === $this) {
                $march->setCategorie(null);
            }
        }

        return $this;
    }
}
