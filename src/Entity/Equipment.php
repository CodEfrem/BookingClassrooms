<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
#[Broadcast]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $option = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'equipment')]
    private Collection $admin;

    public function __construct()
    {
        $this->admin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isOption(): ?bool
    {
        return $this->option;
    }

    public function setOption(bool $option): static
    {
        $this->option = $option;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAdmin(): Collection
    {
        return $this->admin;
    }

    public function addAdmin(User $admin): static
    {
        if (!$this->admin->contains($admin)) {
            $this->admin->add($admin);
            $admin->setEquipment($this);
        }

        return $this;
    }

    public function removeAdmin(User $admin): static
    {
        if ($this->admin->removeElement($admin)) {
            // set the owning side to null (unless already changed)
            if ($admin->getEquipment() === $this) {
                $admin->setEquipment(null);
            }
        }

        return $this;
    }
}
