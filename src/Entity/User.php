<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'clientsInscrits')]
    private Collection $marcheProprietaires;

    #[ORM\ManyToMany(targetEntity: Marche::class)]
    private Collection $marchesFavoris;

    public function __construct()
    {
        $this->marcheProprietaires = new ArrayCollection();
        $this->marchesFavoris = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Marche>
     */
    public function getMarcheProprietaires(): Collection
    {
        return $this->marcheProprietaires;
    }

    public function addMarch(Marche $march): static
    {
        if (!$this->marcheProprietaires->contains($march)) {
            $this->marcheProprietaires->add($march);
            $march->addClientsInscrit($this);
        }

        return $this;
    }

    public function removeMarch(Marche $march): static
    {
        if ($this->marcheProprietaires->removeElement($march)) {
            $march->removeClientsInscrit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Marche>
     */
    public function getMarchesFavoris(): Collection
    {
        return $this->marchesFavoris;
    }

    public function addMarchesFavori(Marche $marchesFavori): static
    {
        if (!$this->marchesFavoris->contains($marchesFavori)) {
            $this->marchesFavoris->add($marchesFavori);
        }

        return $this;
    }

    public function removeMarchesFavori(Marche $marchesFavori): static
    {
        $this->marchesFavoris->removeElement($marchesFavori);

        return $this;
    }
}
