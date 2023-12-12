<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\UnitRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @codeCoverageIgnore
 */
#[ORM\Entity(repositoryClass: UnitRepository::class)]
#[ApiResource]
class Unit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('exercise', 'program')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('exercise', 'program')]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups('exercise', 'program')]
    private ?string $abbreviation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): static
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }
}
