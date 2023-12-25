<?php

namespace FitTrackerApi\Model;

use FitTrackerApi\Entity\Unit;

class ChartSerie
{
    //public ?string $type = null;
    public ?string $name = null;
    public ?string $color = null;
    public ?array $data = null;
    public ?float $pointPadding = null;
    public ?float $pointPlacement = null;
    public ?int $yAxis = null;
    public ?Unit $unit = null;

    // public function getType(): ?string
    // {
    //     return $this->type;
    // }

    // public function setType(string $type): static
    // {
    //     $this->type = $type;

    //     return $this;
    // }

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
