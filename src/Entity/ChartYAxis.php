<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ChartYAxisRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ChartYAxisRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['chart']])]
class ChartYAxis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups('chart')]
    private array $title = [];

    #[ORM\Column]
    #[Groups('chart')]
    private ?int $max = null;

    #[ORM\Column]
    #[Groups('chart')]
    private ?int $min = null;

    #[ORM\Column]
    #[Groups('chart')]
    private ?int $tickInterval = null;

    #[ORM\Column(length: 255)]
    #[Groups('chart')]
    private ?string $gridLineColor = null;

    #[ORM\ManyToOne(inversedBy: 'yAxis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chart $chart = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unit $unit = null;

    #[ORM\Column(nullable: true)]
    #[Groups('chart')]
    private ?bool $opposite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): array
    {
        return $this->title;
    }

    public function setTitle(array $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): static
    {
        $this->max = $max;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function getTickInterval(): ?int
    {
        return $this->tickInterval;
    }

    public function setTickInterval(int $tickInterval): static
    {
        $this->tickInterval = $tickInterval;

        return $this;
    }

    public function getGridLineColor(): ?string
    {
        return $this->gridLineColor;
    }

    public function setGridLineColor(string $gridLineColor): static
    {
        $this->gridLineColor = $gridLineColor;

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

    public function isOpposite(): ?bool
    {
        return $this->opposite;
    }

    public function setOpposite(?bool $opposite): static
    {
        $this->opposite = $opposite;

        return $this;
    }
}
