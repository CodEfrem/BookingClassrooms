<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'You should enter a name.'
    )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'The address must be at least {{ limit }} characters long',
        maxMessage: 'The address cannot be longer than {{ limit }} characters',
    )]
    private ?string $address = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'The city must be at least {{ limit }} characters long',
        maxMessage: 'The city cannot be longer than {{ limit }} characters',
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
        minMessage: 'The country must be at least {{ limit }} characters long',
        maxMessage: 'The country cannot be longer than {{ limit }} characters',
    )]
    private ?string $country = null;

    #[ORM\Column(length: 50)]
    private ?string $gauge = null;

    #[ORM\Column(length: 255)]
    private ?string $floor = null;

    #[ORM\Column(nullable: true)]
    private ?bool $parking = null;

    #[ORM\Column(length: 255)]
    #[Assert\Positive(
        message: 'The price cannot be negative or free.'
    )]
    #[Assert\NotBlank(
        message: 'You should enter a price.'
    )]
    private ?string $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'classrooms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $admin = null;

    #[ORM\ManyToMany(targetEntity: Equipment::class, inversedBy: 'classrooms')]
    private Collection $equipments;

    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'classroom', orphanRemoval: true)]
    private Collection $bookings;


    public function __construct()
    {
        $this->equipments = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getGauge(): ?string
    {
        return $this->gauge;
    }

    public function setGauge(string $gauge): static
    {
        $this->gauge = $gauge;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(string $floor): static
    {
        $this->floor = $floor;

        return $this;
    }

    public function isParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(?bool $parking): static
    {
        $this->parking = $parking;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipment $equipment): static
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments->add($equipment);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): static
    {
        $this->equipments->removeElement($equipment);

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setClassroom($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getClassroom() === $this) {
                $booking->setClassroom(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
