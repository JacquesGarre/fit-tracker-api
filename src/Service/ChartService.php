<?php

namespace FitTrackerApi\Service;

use FitTrackerApi\Entity\Exercise;
use FitTrackerApi\Entity\User;
use FitTrackerApi\Entity\Workout;
use FitTrackerApi\Entity\Unit;
use FitTrackerApi\Entity\Record;
use FitTrackerApi\Entity\WorkoutExercise;
use Doctrine\ORM\EntityManagerInterface;
use FitTrackerApi\Model\Chart;
use FitTrackerApi\Model\ChartXAxis;
use FitTrackerApi\Model\ChartYAxis;
use FitTrackerApi\Model\ChartSerie;

class ChartService 
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ){ }

    private function getWorkoutStartedForUser(User $user): array
    {
        return $this->entityManager->getRepository(Workout::class)
        ->createQueryBuilder('w')
        ->where('w.user = :user')
        ->andWhere('w.startedAt IS NOT NULL')
        ->setParameter('user', $user)
        ->getQuery()
        ->getResult();
    }



    public function getChartsByUserAndExercise(User $user, Exercise $exercise): array
    {

        $workouts = $this->getWorkoutStartedForUser($user);

        $workoutExercises = $this->entityManager->getRepository(WorkoutExercise::class)->findBy([
            'exercise' => $exercise,
            'workout' => $workouts
        ]);
        if(empty($workoutExercises)){
            return [];
        }

        $records = $this->entityManager->getRepository(Record::class)->findBy([
            'user' => $user,
            'workoutExercise' => $workoutExercises
        ]);
        if(empty($records)){
            return [];
        }

        $categories = array_map(function (Workout $workout) {
            return date('d/m/Y H\hi', $workout->getStartedAt()->getTimestamp());
        }, $workouts);
        sort($categories); // Source of bugs: should be ordered by startedAt

        $recordSets = [];
        foreach ($workouts as $workout) {
            $workoutExercise = $workout->getWorkoutExercises()->filter(
                function (WorkoutExercise $workoutExercise) use ($exercise) {
                    return $workoutExercise->getExercise()->getId() == $exercise->getId();
                }
            )->first();
            if (!empty($workoutExercise)) {
                foreach ($workoutExercise->getRecords() as $record) {
                    $date = date('d/m/Y H\hi', $workout->getStartedAt()->getTimestamp());
                    $unitId = $record->getUnit()->getId();
                    $setId = $record->getSetId();
                    $recordSets[$unitId][$setId][$date] = (float) $record->getValue();
                }
            }
        }



        $allKeys = [];
        foreach ($recordSets as $subArray) {
            $allKeys = array_merge($allKeys, array_keys($subArray));
        }
        $allKeys = array_unique($allKeys);
        foreach ($recordSets as &$subArray) {
            $subArray = array_replace(array_fill_keys($allKeys, '0'), $subArray);
        }


        // Set series
        $sets = array_map(function (Record $record) {
            return $record->getSetId();
        }, $records);
        $sets = array_unique($sets);
        sort($sets);

        $charts = [];
        foreach ($exercise->getUnits() as $unit) {
            // Set chart
            $chartTitle = $exercise->getTitle() . ' - ' . $unit->getTitle();
            $chart = new Chart();
            $chart
                ->setChartTitle($chartTitle)
                ->setExercise($exercise)
                ->setTitle(["text" => ""])
                ->setTooltip(["shared" => true])
                ->setPlotOptions([
                    "column" => [
                        "grouping" => false,
                        "shadow" => false,
                        "borderWidth" => 0
                    ]
                ]);

            // Set xAxis
            $xAxis = new ChartXAxis();
            $xAxis->setLabels([
                "rotation" => -45,
                "style" => [
                    "fontSize" => "15px",
                    "marginLeft" => "10px"
                ],
            ]);
            $xAxis->setCategories($categories);
            $chart->addXAxi($xAxis);

            // Set yAxis
            $unitRecords = array_filter($records, function (Record $record) use ($unit) {
                return $record->getUnit()->getId() == $unit->getId();
            });
            $values = array_map(function (Record $record) {
                return (float) ($record->getValue());
            }, $unitRecords);
            $max = !empty($values) ? (int) round(max($values)) + 1 : 0;
            $yAxis = new ChartYAxis();
            $yAxis->setUnit($unit)
                ->setTitle(["text" => ''])
                ->setMax($max)
                ->setMin(0)
                ->setTickInterval(round($max/10))
                ->setGridLineColor("transparent");
            $chart->addYaxi($yAxis);

            // set series
            $pointPadding = 0.4;
            $pointPlacement = -0.075 * (count($sets) - 1);

            foreach ($sets as $setID) {
                $serie = new ChartSerie();
                $serie //->setType("line")
                    ->setUnit($unit)
                    ->setName($unit->getAbbreviation() . " (Set " . $setID . ")")
                    ->setColor('#2dd36f')
                    ->setPointPadding($pointPadding)
                    ->setPointPlacement($pointPlacement)
                    ->setYAxis(0);

                $data = array_values($recordSets[$unit->getId()][$setID]);
                $serie->setData(array_values($data));

                // Add serie
                $chart->addSeries($serie);

                $pointPlacement += 0.15;
            }
            $pointPadding += 0.02;

            $charts[] = $chart;
        }

        return $charts;
    }

    public function getChartsByUser(User $user): array
    {
        $charts = [];
        $exercises = $this->entityManager->getRepository(Exercise::class)->findAll();
        foreach($exercises as $exercise){
            $chartsPerExercise = $this->getChartsByUserAndExercise($user, $exercise);
            if(empty($chartsPerExercise)){
                continue;
            }
            $charts[] = [
                'exercise' => $exercise,
                'charts' => $chartsPerExercise
            ];
        }
        return $charts;
    }

}