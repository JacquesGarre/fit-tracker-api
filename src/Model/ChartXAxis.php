<?php

namespace FitTrackerApi\Model;

class ChartXAxis
{
    public ?array $categories = null;
    public array $labels = [];

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
}
