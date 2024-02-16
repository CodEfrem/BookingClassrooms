<?php

namespace App\Entity;

use App\Repository\SoftwareRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: SoftwareRepository::class)]
class Software
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $softwareName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $version = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $year = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoftwareName(): ?string
    {
        return $this->softwareName;
    }

    public function setSoftwareName(string $softwareName): self
    {
        $this->softwareName = $softwareName;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }
}

