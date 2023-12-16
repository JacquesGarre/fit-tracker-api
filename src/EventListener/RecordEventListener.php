<?php

namespace FitTrackerApi\EventListener;

use FitTrackerApi\Entity\Record;
use FitTrackerApi\Entity\Chart;
use FitTrackerApi\Entity\Workout;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use FitTrackerApi\Entity\ChartSerie;
use FitTrackerApi\Entity\ChartXAxis;
use FitTrackerApi\Entity\ChartYAxis;
use FitTrackerApi\Entity\WorkoutExercise;

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

    public function postPersist(LifecycleEventArgs $args): void
    {
        $record = $args->getObject();
        if (!$record instanceof Record) {
            return;
        }
        $entityManager = $args->getObjectManager();

        $user = $record->getUser();

        // Get the related chart of the exercise and the user
        $chart = $entityManager->getRepository(Chart::class)->findOneBy([
            'exercise' => $record->getWorkoutExercise()->getExercise(),
            'user' => $user
        ]);


        // If the chart doesn't exist, init it
        if(empty($chart)){
            $chart = new Chart();
            $chart->setUser($user)
                ->setExercise($record->getWorkoutExercise()->getExercise())
                ->setTitle(["text" => ""])
                ->setTooltip(["shared" => true])
                ->setPlotOptions([
                    "column" => [
                        "grouping" => false,
                        "shadow" => false,
                        "borderWidth" => 0
                    ]
                ]);
        }
    

        // Reset xAxis
        $chart->removeXAxis();

        // Set xAxis
        $xAxis = new ChartXAxis();
        $xAxis->setLabels(["rotation" => -45]);

        $workouts = $entityManager->getRepository(Workout::class)->findBy([
            'user' => $user
        ]);
        $categories = array_map(function (Workout $workout) {
            return date('dd/mm/YY', $workout->getStartedAt()->getTimestamp());
        }, $workouts);
        array_filter($categories);
        sort($categories); // Source of bugs: should be ordered by startedAt

        $xAxis->setCategories($categories);

        // Add xAxis to chart
        $chart->addXAxi($xAxis);

        // Reset yAxis
        $chart->removeYAxis();

        // Set yAxis
        $yAxisIndexPerUnit = [];
        $index = 0;
        foreach($record->getWorkoutExercise()->getExercise()->getUnits() as $unit){
            $yAxis = new ChartYAxis();
            $yAxis->setUnit($unit)
                ->setTitle(["text" => $unit->getTitle()])
                ->setMax($unit->getMax())
                ->setMin($unit->getMin())
                ->setTickInterval($unit->getTickInterval())
                ->setGridLineColor("transparent");
            if($index % 2 !== 0){
                $yAxis->setOpposite(true);
            }

            $chart->addYaxi($yAxis);

            $yAxisIndexPerUnit[$unit->getId()] = $index;
            $index++;
        }

        // Reset series
        $chart->removeAllSeries();
        
        // Set series
        $sets = array_map(function (Record $record) {
            return $record->getSetId();
        }, $record->getWorkoutExercise()->getRecords()->toArray());
        array_filter($sets);
        sort($sets); // Source of bugs: should be ordered by setId

        $pointPadding = 0.4;
        foreach($record->getWorkoutExercise()->getExercise()->getUnits() as $unit){
            foreach($sets as $setID){

                $serie = new ChartSerie();
                $serie->setType("column")
                    ->setUnit($unit)
                    ->setName($unit->getAbbreviation()." (Set ".$setID.")")
                    ->setColor($unit->getColor())
                    ->setPointPadding($pointPadding)
                    ->setPointPlacement(0.0)
                    ->setYAxis($yAxisIndexPerUnit[$unit->getId()]);
                
                $records = array_filter($record->getWorkoutExercise()->getRecords()->toArray(), function (Record $record) use($setID, $unit) {
                    return $record->getSetId() === $setID && $record->getUnit()->getId() === $unit->getId();
                }); // Source of bugs: Should be ORDER BY workoutExercise ASC
                $data = array_map(function (Record $record) {
                    return $record->getValue();
                }, $records);
                $serie->setData($data);

                // Add serie
                $chart->addSeries($serie);

                $pointPadding += 0.02;
            }
        }

        $entityManager->persist($chart);
        $entityManager->flush();


    }

}
