<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(normalizationContext: ['groups' => ['read']], denormalizationContext: ['groups' => ['write']])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères.',
        maxMessage: 'Le nom doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'Le nom ne peut pas être vide'
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le prénom doit faire au moins {{ limit }} caractères.',
        maxMessage: 'Le prénom doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'Le prénom ne peut pas être vide'
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'L\'email doit faire au moins {{ limit }} caractères.',
        maxMessage: 'L\'email doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'L\'email ne peut pas être vide'
    )]

    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        exactly: 10,
        exactMessage: 'Le numéro de téléphone doit faire exactement {{ limit }} chiffres.'
    )]
    #[Assert\Regex(
        pattern: '/^0[0-9]{9}$/',
        message: 'Le numéro de téléphone doit commencer par 0 suivi de 9 chiffres.'
    )]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'L\'adresse doit faire au moins {{ limit }} caractères.',
        maxMessage: 'L\'adresse doit faire moins de {{ limit }} caractères.'
    )]
    #[Assert\NotBlank(
        message: 'L\'adresse ne peut pas être vide'
    )]
    private ?string $adresse = null;

    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'clientsInscrits')]
    private Collection $marches_inscrits;

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
    public function getMarcheInscrits(): Collection
    {
        return $this->marches_inscrits;
    }

    public function addMarche(Marche $march): static
    {
        if (!$this->marches_inscrits->contains($march)) {
            $this->marches_inscrits->add($march);
            $march->addClientsInscrit($this);
        }

        return $this;
    }

    public function removeMarch(Marche $march): static
    {
        if ($this->marches_inscrits->removeElement($march)) {
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
