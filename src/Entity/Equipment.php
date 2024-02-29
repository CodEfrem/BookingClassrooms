<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $option = null;

    #[ORM\Column (type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'equipments')]
    private ?User $admin = null;

    #[ORM\ManyToMany(targetEntity: Classroom::class, inversedBy: 'equipment')]
    private Collection $classroom;

    public function __construct()
    {
        $this->classroom = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function isOption(): ?string
    {
        return $this->option;
    }

    public function setOption(string $option): static
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

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function __toString() {

        return $this->option; // Retourne le nom de l'équipement
    }

    /**
     * @return Collection<int, Classroom>
     */
    public function getClassroom(): Collection
    {
        return $this->classroom;
    }

    public function addClassroom(Classroom $classroom): static
    {
        if (!$this->classroom->contains($classroom)) {
            $this->classroom->add($classroom);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): static
    {
        $this->classroom->removeElement($classroom);

        return $this;
    }

}
