<?php

namespace FitTrackerApi\EventListener;

use DateTimeImmutable;
use FitTrackerApi\Entity\Workout;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use FitTrackerApi\Entity\WorkoutExercise;

class WorkoutEventListener
{
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Workout) {
            return;
        }
        $entityManager = $args->getObjectManager();
        foreach ($entity->getProgram()->getProgramExercises() as $programExercise) {
            $workoutExercise = new WorkoutExercise();
            $workoutExercise->setExercise($programExercise->getExercise());
            $workoutExercise->setWorkout($entity);
            $entityManager->persist($workoutExercise);
        }
        $entityManager->flush();
    }
}
