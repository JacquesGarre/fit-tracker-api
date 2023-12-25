<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\RecordRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RecordRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['workout']])]
class Record
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('workout')]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('workout')]
    private ?Unit $unit = null;

    #[ORM\Column(length: 255)]
    #[Groups('workout')]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'records')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'records')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WorkoutExercise $workoutExercise = null;

    #[ORM\Column]
    #[Groups('workout')]
    private ?int $setId = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getWorkoutExercise(): ?WorkoutExercise
    {
        return $this->workoutExercise;
    }

    public function setWorkoutExercise(?WorkoutExercise $workoutExercise): static
    {
        $this->workoutExercise = $workoutExercise;

        return $this;
    }

    public function getSetId(): ?int
    {
        return $this->setId;
    }

    public function setSetId(int $setId): static
    {
        $this->setId = $setId;

        return $this;
    }
}
