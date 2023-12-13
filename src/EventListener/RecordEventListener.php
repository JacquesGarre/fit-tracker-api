<?php

namespace FitTrackerApi\EventListener;

use FitTrackerApi\Entity\Record;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class RecordEventListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Record) {
            return;
        }
        $entityManager = $args->getObjectManager();

        $existingRecord = $entityManager->getRepository(Record::class)->findOneBy([
            'unit' => $entity->getUnit(),
            'user' => $entity->getUser(),
            'workoutExercise' => $entity->getWorkoutExercise(),
            'setId' => $entity->getSetId(),
        ]);

        if ($existingRecord) {
            $entityManager->remove($existingRecord);
            $entityManager->flush();
        }
    }
}
