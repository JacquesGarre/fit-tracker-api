<?php

namespace FitTrackerApi\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FitTrackerApi\Entity\Exercise;

class Chart
{
    public ?Exercise $exercise = null;
    public string $chartTitle = '';
    public array $legend = ["enabled" => false];
    public $backgroundColor = 'transparent';
    public array $title = [];
    public array $tooltip = [];
    public array $plotOptions = [];
    public Collection $xAxis;
    public Collection $yAxis;
    public Collection $series;

    public function __construct()
    {
        $this->xAxis = new ArrayCollection();
        $this->yAxis = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
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

    public function getChartTitle(): string
    {
        return $this->chartTitle;
    }

    public function setChartTitle(string $title): static
    {
        $this->chartTitle = $title;

        return $this;
    }


    public function getTooltip(): array
    {
        return $this->tooltip;
    }

    public function setTooltip(array $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    public function getPlotOptions(): array
    {
        return $this->plotOptions;
    }

    public function setPlotOptions(array $plotOptions): static
    {
        $this->plotOptions = $plotOptions;

        return $this;
    }

    /**
     * @return Collection<int, ChartXAxis>
     */
    public function getXAxis(): Collection
    {
        return $this->xAxis;
    }

    public function addXAxi(ChartXAxis $xAxi): static
    {
        $this->xAxis->add($xAxi);
        return $this;
    }

    public function removeXAxis(): static
    {
        $this->xAxis = new ArrayCollection();
        return $this;
    }

    public function removeYAxis(): static
    {
        $this->yAxis = new ArrayCollection();
        return $this;
    }

    public function removeXAxi(ChartXAxis $xAxi): static
    {
        $this->xAxis->removeElement($xAxi);
        return $this;
    }

    /**
     * @return Collection<int, ChartYAxis>
     */
    public function getYAxis(): Collection
    {
        return $this->yAxis;
    }

    public function addYAxi(ChartYAxis $yAxi): static
    {
        $this->yAxis->add($yAxi);
        return $this;
    }

    public function removeYAxi(ChartYAxis $yAxi): static
    {
        $this->yAxis->removeElement($yAxi);
        return $this;
    }

    /**
     * @return Collection<int, ChartSerie>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(ChartSerie $series): static
    {
        $existingSerie = array_filter(
            $this->series->toArray(),
            function (ChartSerie $serie) use ($series) {
                return $serie->getName() == $series->getName();
            }
        );
        if ($existingSerie) {
            return $this;
        }
        $this->series->add($series);
        return $this;
    }

    public function removeSeries(ChartSerie $series): static
    {
        $this->series->removeElement($series);
        return $this;
    }

    public function removeAllSeries(): static
    {
        $this->series = new ArrayCollection();
        return $this;
    }
}
