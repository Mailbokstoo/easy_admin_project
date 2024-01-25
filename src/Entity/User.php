<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

// #[ApiResource(
//     normalizationContext: ['groups' => ['get']],
//     denormalizationContext: ['groups' => ['post']],
//     denormalizationContext: ['groups' => ['put']],
// )]

#[ApiResource(operations: [
    new Post(normalizationContext: ['groups' => ['post']]),
    new Get(normalizationContext: ['groups' => ['get']]),
    new GetCollection(normalizationContext: ['groups' => ['getList']]),
    ],
    paginationEnabled: false
)]
//     normalizationContext: ['groups' => ['get']],
//     denormalizationContext: ['groups' => ['post']],
//     denormalizationContext: ['groups' => ['put']],
// )]

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Groups(['get','getList'])]
    #[ORM\Column]
    private ?string $password = null;

    #[Groups(['post', 'get','getList'])]
    #[ORM\Column(length: 60)]
    private ?string $prenom = null;

    #[Groups(['post', 'get','getList'])]
    #[ORM\Column(length: 60)]
    private ?string $nom = null;

    #[Groups(['get'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[Groups(['get'])]
    #[ORM\Column(nullable: true)]
    private ?int $code_postal = null;

    #[Groups(['get','getList'])]
    #[ORM\Column(length: 60, nullable: true)]
    private ?string $ville = null;

    #[Groups(['post', 'get'])]
    #[ORM\Column(length: 60, nullable: true)]
    private ?string $telephone = null;


    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(?int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function __toString(): string
    {       
        return $this->getFullName();
    }

    public function getFullName(): string
    {       
        $name_all = $this->getPrenom() . " " . $this->getNom();
        return $name_all ;
    }



}
