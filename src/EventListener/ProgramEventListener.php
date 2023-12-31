<?php

namespace FitTrackerApi\EventListener;

use FitTrackerApi\Entity\Program;
use FitTrackerApi\Entity\Workout;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProgramEventListener
{
    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Program) {
            return;
        }
        $entityManager = $args->getObjectManager();


        if($entity->isSoftDeleted()){
            $workoutsToDelete = $entityManager->getRepository(Workout::class)->findBy([
                'program' => $entity,
                'status' => 'planned',
            ]);
            foreach($workoutsToDelete as $workout){
                $entityManager->remove($workout);
                $entityManager->flush();
            }
        }
    }
}
