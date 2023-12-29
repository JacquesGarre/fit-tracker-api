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

    #[ORM\OneToMany(mappedBy: 'exercise', targetEntity: ProgramExercise::class, orphanRemoval: true)]
    private Collection $programExercises;

    #[ORM\Column(nullable: true)]
    #[Groups('exercise')]
    private ?int $difficulty = null;

    #[ORM\ManyToMany(targetEntity: MuscleGroup::class, inversedBy: 'exercises')]
    #[Groups('exercise')]
    private Collection $muscleGroups;

    #[ORM\ManyToMany(targetEntity: ExerciseType::class, inversedBy: 'exercises')]
    #[Groups('exercise')]
    private Collection $type;

    public function __construct()
    {
        $this->units = new ArrayCollection();
        $this->workoutExercises = new ArrayCollection();
        $this->programExercises = new ArrayCollection();
        $this->muscleGroups = new ArrayCollection();
        $this->type = new ArrayCollection();
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

    /**
     * @return Collection<int, ProgramExercise>
     */
    public function getProgramExercises(): Collection
    {
        return $this->programExercises;
    }

    public function addProgramExercise(ProgramExercise $programExercise): static
    {
        if (!$this->programExercises->contains($programExercise)) {
            $this->programExercises->add($programExercise);
            $programExercise->setExercise($this);
        }

        return $this;
    }

    public function removeProgramExercise(ProgramExercise $programExercise): static
    {
        if ($this->programExercises->removeElement($programExercise)) {
            // set the owning side to null (unless already changed)
            if ($programExercise->getExercise() === $this) {
                $programExercise->setExercise(null);
            }
        }

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(?int $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return Collection<int, MuscleGroup>
     */
    public function getMuscleGroups(): Collection
    {
        return $this->muscleGroups;
    }

    public function addMuscleGroup(MuscleGroup $muscleGroup): static
    {
        if (!$this->muscleGroups->contains($muscleGroup)) {
            $this->muscleGroups->add($muscleGroup);
        }

        return $this;
    }

    public function removeMuscleGroup(MuscleGroup $muscleGroup): static
    {
        $this->muscleGroups->removeElement($muscleGroup);

        return $this;
    }

    /**
     * @return Collection<int, ExerciseType>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(ExerciseType $type): static
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
        }

        return $this;
    }

    public function removeType(ExerciseType $type): static
    {
        $this->type->removeElement($type);

        return $this;
    }
}
