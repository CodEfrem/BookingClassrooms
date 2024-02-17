<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
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

    #[ORM\ManyToOne(inversedBy: 'equipments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $admin = null;

    // Ajout de la relation ManyToMany avec Software
    #[ORM\ManyToMany(targetEntity: Software::class, mappedBy: 'equipments')]
    private Collection $softwares; // Fin de l'ajout

    #[ORM\ManyToMany(targetEntity: Classroom::class, mappedBy: 'equipments')]
    private Collection $classrooms;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
        $this->softwares = new ArrayCollection(); // Initialisation de la collection pour la relation ManyToMany avec Software
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
     * @return Collection<int, Classroom>
     */
    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): static
    {
        if (!$this->classrooms->contains($classroom)) {
            $this->classrooms->add($classroom);
            $classroom->addEquipment($this);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): static
    {
        if ($this->classrooms->removeElement($classroom)) {
            $classroom->removeEquipment($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Software>
     */
    public function getSoftwares(): Collection
    {
        return $this->softwares;
    }

    public function addSoftware(Software $software): static
    {
        if (!$this->softwares->contains($software)) {
            $this->softwares->add($software);
            $software->addEquipment($this);
        }

        return $this;
    }

    public function removeSoftware(Software $software): static
    {
        if ($this->softwares->removeElement($software)) {
            $software->removeEquipment($this);
        }

        return $this;
    }

}
