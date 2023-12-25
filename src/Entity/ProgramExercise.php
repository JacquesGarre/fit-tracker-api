<?php

namespace FitTrackerApi\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FitTrackerApi\Repository\ProgramExerciseRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: ProgramExerciseRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['program', 'exercise']])]
#[ApiFilter(SearchFilter::class, properties: ['program' => 'exact', 'exercise' => 'exact'])]
class ProgramExercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'programExercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Program $program = null;

    #[ORM\ManyToOne(inversedBy: 'programExercises')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('program', 'exercise')]
    private ?Exercise $exercise = null;

    #[ORM\Column(nullable: true)]
    #[Groups('program')]
    private ?int $sets = null;

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

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getSets(): ?int
    {
        return $this->sets;
    }

    public function setSets(?int $sets): static
    {
        $this->sets = $sets;

        return $this;
    }
}
