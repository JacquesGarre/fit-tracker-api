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
        foreach ($entity->getProgram()->getExercises() as $exercise) {
            $workoutExercise = new WorkoutExercise();
            $workoutExercise->setExercise($exercise);
            $workoutExercise->setWorkout($entity);
            $entityManager->persist($workoutExercise);
        }
        $entityManager->flush();
    }
}
