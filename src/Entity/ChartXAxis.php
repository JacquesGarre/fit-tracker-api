<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ChartXAxisRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ChartXAxisRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['chart']])]
class ChartXAxis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('chart')]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    #[Groups('chart')]
    private ?array $categories = null;

    #[ORM\Column]
    #[Groups('chart')]
    private array $labels = [];

    #[ORM\ManyToOne(inversedBy: 'xAxis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chart $chart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function setCategories(?array $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function setLabels(array $labels): static
    {
        $this->labels = $labels;

        return $this;
    }

    public function getChart(): ?Chart
    {
        return $this->chart;
    }

    public function setChart(?Chart $chart): static
    {
        $this->chart = $chart;

        return $this;
    }
}
