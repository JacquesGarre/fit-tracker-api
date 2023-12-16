<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ChartRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ChartRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['chart', 'workout', 'exercise']])]
class Chart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('chart')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'charts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('chart')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'charts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('chart')]
    private ?Exercise $exercise = null;

    #[ORM\Column]
    #[Groups('chart')]
    private array $title = [];

    #[ORM\Column]
    #[Groups('chart')]
    private array $tooltip = [];

    #[ORM\Column]
    #[Groups('chart')]
    private array $plotOptions = [];

    #[ORM\OneToMany(mappedBy: 'chart', targetEntity: ChartXAxis::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups('chart')]
    private Collection $xAxis;

    #[ORM\OneToMany(mappedBy: 'chart', targetEntity: ChartYAxis::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups('chart')]
    private Collection $yAxis;

    #[ORM\OneToMany(mappedBy: 'chart', targetEntity: ChartSerie::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups('chart')]
    private Collection $series;


    public function __construct()
    {
        $this->xAxis = new ArrayCollection();
        $this->yAxis = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
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
        if (!$this->xAxis->contains($xAxi)) {
            $this->xAxis->add($xAxi);
            $xAxi->setChart($this);
        }

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
        if ($this->xAxis->removeElement($xAxi)) {
            // set the owning side to null (unless already changed)
            if ($xAxi->getChart() === $this) {
                $xAxi->setChart(null);
            }
        }

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
        if (!$this->yAxis->contains($yAxi)) {
            $this->yAxis->add($yAxi);
            $yAxi->setChart($this);
        }

        return $this;
    }

    public function removeYAxi(ChartYAxis $yAxi): static
    {
        if ($this->yAxis->removeElement($yAxi)) {
            // set the owning side to null (unless already changed)
            if ($yAxi->getChart() === $this) {
                $yAxi->setChart(null);
            }
        }

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
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->setChart($this);
        }

        return $this;
    }

    public function removeSeries(ChartSerie $series): static
    {
        if ($this->series->removeElement($series)) {
            // set the owning side to null (unless already changed)
            if ($series->getChart() === $this) {
                $series->setChart(null);
            }
        }

        return $this;
    }

    public function removeAllSeries(): static
    {
        $this->series = new ArrayCollection();
        return $this;
    }

}
