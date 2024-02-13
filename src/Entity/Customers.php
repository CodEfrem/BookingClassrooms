<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
#[Broadcast]
class Customers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $effective = null;

    #[ORM\Column]
    private ?int $booking_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getEffective(): ?int
    {
        return $this->effective;
    }

    public function setEffective(int $effective): static
    {
        $this->effective = $effective;

        return $this;
    }

    public function getBookingId(): ?int
    {
        return $this->booking_id;
    }

    public function setBookingId(int $booking_id): static
    {
        $this->booking_id = $booking_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
