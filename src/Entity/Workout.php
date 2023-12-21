<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\WorkoutRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: WorkoutRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['workout', 'exercise', 'program']])]
#[ApiFilter(SearchFilter::class, properties: ['status' => 'exact'])]
class Workout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('workout')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'workouts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('workout')]
    private ?Program $program = null;

    #[ORM\ManyToOne(inversedBy: 'workouts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('workout')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    #[Groups('workout')]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups('workout')]
    private ?\DateTimeImmutable $endedAt = null;

    #[ORM\OneToMany(mappedBy: 'workout', targetEntity: WorkoutExercise::class, orphanRemoval: true)]
    #[Groups('workout')]
    private Collection $workoutExercises;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function __construct()
    {
        $this->workoutExercises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): static
    {
        $this->program = $program;

        return $this;
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

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTimeImmutable $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): static
    {
        $this->endedAt = $endedAt;

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
            $workoutExercise->setWorkout($this);
        }

        return $this;
    }

    public function removeWorkoutExercise(WorkoutExercise $workoutExercise): static
    {
        if ($this->workoutExercises->removeElement($workoutExercise)) {
            // set the owning side to null (unless already changed)
            if ($workoutExercise->getWorkout() === $this) {
                $workoutExercise->setWorkout(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
