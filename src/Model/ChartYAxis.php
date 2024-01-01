<?php

namespace FitTrackerApi\Model;

use FitTrackerApi\Entity\Unit;

class ChartYAxis
{
    public array $title = [];
    public ?int $max = null;
    public ?int $min = null;
    public ?float $tickInterval = null;
    public ?string $gridLineColor = null;
    public ?Unit $unit = null;
    public ?bool $opposite = null;
    public int $tickAmount = 6;
    public array $labels = [
        "style" => [
            "color" => "#fff",
            "fontSize" => "10px",
        ]
    ];

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

    public function getTickInterval(): ?float
    {
        return $this->tickInterval;
    }

    public function setTickInterval(float $tickInterval): static
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
