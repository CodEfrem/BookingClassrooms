<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Mime\Message;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(
        message: 'The email "{{ value }}" is not a valid email. Try again.',
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Regex(
        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        message: 'Your password must contain : at least 1 uppercase letter, 1 lowercase letter, 1 number, at least 1 special character, at least 8 characters'
    )]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your name must be at least {{ limit }} characters long',
        maxMessage: 'Your name cannot be longer than {{ limit }} characters',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Your corporate_name must be at least {{ limit }} characters long',
        maxMessage: 'Your corporate_name cannot be longer than {{ limit }} characters',
    )]
    private ?string $corporate_name = null;

    #[ORM\Column(length: 14)]
    #[Assert\Length(
        exactly: 14,
        exactMessage:'Your siret must be at {{limit}} characters long',
    )] 
    private ?string $siret = null;

    #[ORM\Column(length: 15, nullable: true)]
    #[Assert\Length(
        exactly: 15,
        exactMessage:'Your phone must be at {{limit}} characters long',
    )] 
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your address must be at least {{ limit }} characters long',
        maxMessage: 'Your address cannot be longer than {{ limit }} characters',
    )]
    private ?string $address = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your city must be at least {{ limit }} characters long',
        maxMessage: 'Your city cannot be longer than {{ limit }} characters',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(
        min: 5,
        max: 20,
        minMessage: 'Your zip must be at least {{ limit }} characters long',
        maxMessage: 'Your zip cannot be longer than {{ limit }} characters',
    )]
    private ?string $zip = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your country must be at least {{ limit }} characters long',
        maxMessage: 'Your country cannot be longer than {{ limit }} characters',
    )]
    private ?string $country = null;

    #[ORM\Column(nullable: true)]
    private ?bool $consent = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\ManyToOne(inversedBy: 'admin')]
    private ?Equipments $equipment = null;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCorporateName(): ?string
    {
        return $this->corporate_name;
    }

    public function setCorporateName(string $corporate_name): static
    {
        $this->corporate_name = $corporate_name;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function isConsent(): ?bool
    {
        return $this->consent;
    }

    public function setConsent(?bool $consent): static
    {
        $this->consent = $consent;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getEquipment(): ?Equipments
    {
        return $this->equipment;
    }

    public function setEquipment(?Equipments $equipment): static
    {
        $this->equipment = $equipment;

        return $this;
    }
}
