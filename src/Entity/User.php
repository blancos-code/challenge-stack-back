<?php

namespace App\Entity;

use ORM\DiscriminatorColumn;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: UserRepository::class)]
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
    #[Groups(["read", "write"])]
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
    #[Groups(["read", "write"])]
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
    #[Groups(["read", "write"])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        exactly: 10,
        exactMessage: 'Le numéro de téléphone doit faire exactement {{ limit }} chiffres.'
    )]
    #[Assert\Regex(
        pattern: '/^(0|\+33|00)[1-9][0-9]{8}$/',
        message: 'Le numéro de téléphone doit commencer par 0, +33, ou 00 suivi de 9 chiffres.'
    )]
    #[Groups(["read", "write"])]
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
    #[Groups(["read", "write"])]
    private ?string $adresse = null;

    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'clientsInscrits')]
    private Collection $marchesInscrits;

    #[ORM\ManyToMany(targetEntity: Marche::class)]
    private Collection $marchesFavoris;

    #[ORM\OneToMany(mappedBy: 'proprietaire', targetEntity: Marche::class)]
    private Collection $marchesProprietaire;

    #[ORM\OneToMany(mappedBy: 'redacteur', targetEntity: CommentaireMarche::class)]
    private Collection $commentaireMarches;

    #[ORM\OneToMany(mappedBy: 'redacteur', targetEntity: CommentaireProducteur::class)]
    private Collection $commentaireProducteurs;

    #[ORM\Column]
    #[Groups(["read", "write"])]
    private ?bool $isBanned = null;
    
    #[ORM\Column(length: 255,nullable: true)]
    #[Groups(["read", "write"])]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'user_image', fileNameProperty: 'imageName')]
    #[Groups(["read", "write"])]
    private ?File $imageFile = null;
    
    #[ORM\Column(type: 'datetime_immutable',nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;


    public function __construct()
    {
        $this->marchesInscrits = new ArrayCollection();
        $this->marchesFavoris = new ArrayCollection();
        $this->marchesProprietaire = new ArrayCollection();
        $this->commentaireMarches = new ArrayCollection();
        $this->commentaireProducteurs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return strtoupper($this->nom)." ".$this->prenom; // Modifier en fonction de votre logique
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
        return $this->marchesInscrits;
    }

    public function addMarche(Marche $march): static
    {
        if (!$this->marchesInscrits->contains($march)) {
            $this->marchesInscrits->add($march);
            $march->addClientsInscrit($this);
        }

        return $this;
    }

    public function removeMarche(Marche $march): static
    {
        if ($this->marchesInscrits->removeElement($march)) {
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

    /**
     * @return Collection<int, Marche>
     */
    public function getMarchesProprietaire(): Collection
    {
        return $this->marchesProprietaire;
    }

    public function addMarchesProprietaire(Marche $marchesProprietaire): static
    {
        if (!$this->marchesProprietaire->contains($marchesProprietaire)) {
            $this->marchesProprietaire->add($marchesProprietaire);
        }

        return $this;
    }

    public function removeMarchesProprietaire(Marche $marchesProprietaire): static
    {
        $this->marchesProprietaire->removeElement($marchesProprietaire);

        return $this;
    }

    /**
     * @return Collection<int, CommentaireMarche>
     */
    public function getCommentaireMarches(): Collection
    {
        return $this->commentaireMarches;
    }

    public function addCommentaireMarch(CommentaireMarche $commentaireMarch): static
    {
        if (!$this->commentaireMarches->contains($commentaireMarch)) {
            $this->commentaireMarches->add($commentaireMarch);
            $commentaireMarch->setRedacteur($this);
        }
        
        return $this;
    }

    public function removeCommentaireMarch(CommentaireMarche $commentaireMarch): static
    {
        if ($this->commentaireMarches->removeElement($commentaireMarch)) {
            // set the owning side to null (unless already changed)
            if ($commentaireMarch->getRedacteur() === $this) {
                $commentaireMarch->setRedacteur(null);
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
            $commentaireProducteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeCommentaireProducteur(CommentaireProducteur $commentaireProducteur): static
    {
        if ($this->commentaireProducteurs->removeElement($commentaireProducteur)) {
            // set the owning side to null (unless already changed)
            if ($commentaireProducteur->getRedacteur() === $this) {
                $commentaireProducteur->setRedacteur(null);
            }
        }

        return $this;
    }

    public function isIsBanned(): ?bool
    {
        return $this->isBanned;
    }

    public function setIsBanned(bool $isBanned): static
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
      $this->imageFile = $imageFile;

      if (null !== $imageFile) {
            // Il faut biensur que la propriété updatedAt soit crée sur l'Entity.
            $this->updatedAt = new \DateTimeImmutable();
        }

    }

    public function getImageFile(): ?File
    {
      return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    { 
        $this->imageName = $imageName;
    }
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}
