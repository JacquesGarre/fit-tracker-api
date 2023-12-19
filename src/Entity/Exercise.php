<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ExerciseRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['exercise', 'program', 'workout']])]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('exercise', 'program', 'workout', 'chart')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('exercise', 'program', 'workout', 'chart')]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Unit::class)]
    #[Groups('exercise')]
    private Collection $units;

    #[ORM\OneToMany(mappedBy: 'exercise', targetEntity: WorkoutExercise::class)]
    private Collection $workoutExercises;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('exercise')]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('exercise')]
    private ?string $miniature = null;

    public function __construct()
    {
        $this->units = new ArrayCollection();
        $this->workoutExercises = new ArrayCollection();
        $this->charts = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Unit>
     */
    public function getUnits(): Collection
    {
        return $this->units;
    }

    public function addUnit(Unit $unit): static
    {
        if (!$this->units->contains($unit)) {
            $this->units->add($unit);
        }

        return $this;
    }

    public function removeUnit(Unit $unit): static
    {
        $this->units->removeElement($unit);

        return $this;
    }

    /**
     * @return Collection<int, WorkoutExercise>
     */
    public function getWorkoutExercises(): Collection
    {
        return $this->workoutExercises;
    }

    public function addWorkoutExercise(WorkoutExercise $workoutExercise): static
    {
        if (!$this->workoutExercises->contains($workoutExercise)) {
            $this->workoutExercises->add($workoutExercise);
            $workoutExercise->setExercise($this);
        }

        return $this;
    }

    public function removeWorkoutExercise(WorkoutExercise $workoutExercise): static
    {
        if ($this->workoutExercises->removeElement($workoutExercise)) {
            // set the owning side to null (unless already changed)
            if ($workoutExercise->getExercise() === $this) {
                $workoutExercise->setExercise(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMiniature(): ?string
    {
        return $this->miniature;
    }

    public function setMiniature(?string $miniature): static
    {
        $this->miniature = $miniature;

        return $this;
    }
}
