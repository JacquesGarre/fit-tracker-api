<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ChartSerieRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ChartSerieRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['chart']])]
class ChartSerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('chart')]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups('chart')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups('chart')]
    private ?string $color = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    #[Groups('chart')]
    private ?array $data = null;

    #[ORM\Column]
    #[Groups('chart')]
    private ?float $pointPadding = null;

    #[ORM\Column]
    #[Groups('chart')]
    private ?float $pointPlacement = null;

    #[ORM\Column]
    #[Groups('chart')]
    private ?int $yAxis = null;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?Chart $chart = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unit $unit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getPointPadding(): ?float
    {
        return $this->pointPadding;
    }

    public function setPointPadding(float $pointPadding): static
    {
        $this->pointPadding = $pointPadding;

        return $this;
    }

    public function getPointPlacement(): ?float
    {
        return $this->pointPlacement;
    }

    public function setPointPlacement(float $pointPlacement): static
    {
        $this->pointPlacement = $pointPlacement;

        return $this;
    }

    public function getYAxis(): ?int
    {
        return $this->yAxis;
    }

    public function setYAxis(int $yAxis): static
    {
        $this->yAxis = $yAxis;

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

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }
}
