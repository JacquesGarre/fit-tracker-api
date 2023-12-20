<?php

declare(strict_types=1);

namespace FitTrackerApi\Controller;

use FitTrackerApi\Model\Chart;
use FitTrackerApi\Model\ChartXAxis;
use FitTrackerApi\Model\ChartYAxis;
use FitTrackerApi\Model\ChartSerie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use FitTrackerApi\Entity\Exercise;
use FitTrackerApi\Entity\Record;
use FitTrackerApi\Entity\Workout;
use FitTrackerApi\Entity\WorkoutExercise;
use Symfony\Component\Serializer\SerializerInterface;

class ChartController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    #[Route('/charts/{exerciseId}', name: "get_chart", methods: ["GET"])]
    public function getChart(string $exerciseId): JsonResponse
    {

        $user = $this->getUser();
        $exercise = $this->entityManager->getRepository(Exercise::class)->findOneBy([
            'id' => $exerciseId
        ]);

        $workouts = $this->entityManager->getRepository(Workout::class)->findBy([
            'user' => $user
        ]);

        $workoutExercises = $this->entityManager->getRepository(WorkoutExercise::class)->findBy([
            'exercise' => $exercise,
            'workout' => $workouts
        ]);
        $records = $this->entityManager->getRepository(Record::class)->findBy([
            'user' => $user,
            'workoutExercise' => $workoutExercises
        ]);
        
        $categories = array_map(function (Workout $workout) {
            return date('d/m/Y H\hi', $workout->getStartedAt()->getTimestamp());
        }, $workouts);
        sort($categories); // Source of bugs: should be ordered by startedAt

        $recordSets = [];
        foreach($workouts as $workout){   
            $workoutExercise = $workout->getWorkoutExercises()->filter(function (WorkoutExercise $workoutExercise) use($exercise) {
                return $workoutExercise->getExercise()->getId() == $exercise->getId();
            })->first();

            if(!empty($workoutExercise)){
                foreach($workoutExercise->getRecords() as $record){                
                    $recordSets[$record->getUnit()->getId()][$record->getSetId()][date('d/m/Y H\hi', $workout->getStartedAt()->getTimestamp())] = (float) $record->getValue();
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

        foreach($exercise->getUnits() as $unit){

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
            $values = array_map(function(Record $record) {
                return (float) ($record->getValue());
            }, $unitRecords);
            $max = !empty($values) ? (int) round(max($values)) + 1 : 0;
            $yAxis = new ChartYAxis();
            $yAxis->setUnit($unit)
                ->setTitle(["text" => ''])
                ->setMax($max)
                ->setMin(0)
                ->setTickInterval($unit->getTickInterval())
                ->setGridLineColor("transparent");
            $chart->addYaxi($yAxis);

            // set series
            $pointPadding = 0.4;
            $pointPlacement = -0.075*(count($sets) - 1);

            foreach($sets as $setID){

                $serie = new ChartSerie();
                $serie->setType("column")
                    ->setUnit($unit)
                    ->setName($unit->getAbbreviation()." (Set ".$setID.")")
                    ->setColor($unit->getColor())
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

        $jsonCharts = $this->serializer->serialize($charts, 'json');
        return new JsonResponse(json_decode($jsonCharts, true));

    }
}