<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ProgramRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['program', 'exercise']])]
#[ApiFilter(SearchFilter::class, properties: ['softDeleted' => 'exact'])]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('program')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('program', 'workout')]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('program')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'program', targetEntity: Workout::class)]
    private Collection $workouts;

    #[ORM\Column(nullable: true)]
    #[Groups('program')]
    private bool $softDeleted = false;

    #[ORM\OneToMany(
        mappedBy: 'program',
        targetEntity: ProgramExercise::class,
        orphanRemoval: true,
        cascade: ['persist']
    )]
    #[Groups('program')]
    private Collection $programExercises;

    public function __construct()
    {
        //$this->exercises = new ArrayCollection();
        $this->workouts = new ArrayCollection();
        $this->programExercises = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Workout>
     */
    public function getWorkouts(): Collection
    {
        return $this->workouts;
    }

    public function addWorkout(Workout $workout): static
    {
        if (!$this->workouts->contains($workout)) {
            $this->workouts->add($workout);
            $workout->setProgram($this);
        }

        return $this;
    }

    public function removeWorkout(Workout $workout): static
    {
        if ($this->workouts->removeElement($workout)) {
            // set the owning side to null (unless already changed)
            if ($workout->getProgram() === $this) {
                $workout->setProgram(null);
            }
        }

        return $this;
    }

    public function isSoftDeleted(): ?bool
    {
        return $this->softDeleted;
    }

    public function setSoftDeleted(?bool $softDeleted): static
    {
        $this->softDeleted = $softDeleted;

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
            $programExercise->setProgram($this);
        }

        return $this;
    }

    public function removeProgramExercise(ProgramExercise $programExercise): static
    {
        if ($this->programExercises->removeElement($programExercise)) {
            // set the owning side to null (unless already changed)
            if ($programExercise->getProgram() === $this) {
                $programExercise->setProgram(null);
            }
        }

        return $this;
    }
}
