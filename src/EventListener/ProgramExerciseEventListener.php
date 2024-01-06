<?php

namespace FitTrackerApi\EventListener;

use FitTrackerApi\Entity\ProgramExercise;
use FitTrackerApi\Entity\Workout;
use FitTrackerApi\Entity\WorkoutExercise;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProgramExerciseEventListener
{
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof ProgramExercise) {
            return;
        }
        $entityManager = $args->getObjectManager();
        $workoutsToUpdate = $entityManager->getRepository(Workout::class)->findBy([
            'program' => $entity->getProgram(),
            'status' => ['in-progress', 'planned'],
        ]);
        foreach($workoutsToUpdate as $workout){
            $workoutExercise = new WorkoutExercise();
            $workoutExercise->setExercise($entity->getExercise());
            $workout->addWorkoutExercise($workoutExercise);
            $entityManager->persist($workout);
            $entityManager->flush();
        }       
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof ProgramExercise) {
            return;
        }
        $entityManager = $args->getObjectManager();
        $workoutsToUpdate = $entityManager->getRepository(Workout::class)->findBy([
            'program' => $entity->getProgram(),
            'status' => ['in-progress', 'planned'],
        ]);
        foreach($workoutsToUpdate as $workout){
            $workoutExercise = new WorkoutExercise();
            $workoutExercise->setExercise($entity->getExercise());
            $workout->removeWorkoutExercise($workoutExercise);
            $entityManager->persist($workout);
            $entityManager->flush();
        }    
    }

}
