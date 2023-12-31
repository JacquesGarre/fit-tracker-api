<?php

declare(strict_types=1);

namespace FitTrackerApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use FitTrackerApi\Entity\Exercise;
use FitTrackerApi\Service\ChartService;
use Symfony\Component\Serializer\SerializerInterface;

class ChartController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer,
        private ChartService $chartService
    ) {

    }

    #[Route('/charts/exercise/{exerciseId}', name: "get_chart_by_exercise", methods: ["GET"])]
    public function getChartByExercise(string $exerciseId): JsonResponse
    {
        $user = $this->getUser();
        $exercise = $this->entityManager->getRepository(Exercise::class)->findOneBy([
            'id' => $exerciseId
        ]);
        $charts = $this->chartService->getChartsByUserAndExercise($user, $exercise);
        $jsonCharts = $this->serializer->serialize($charts, 'json');
        return new JsonResponse(json_decode($jsonCharts, true));
    }

    #[Route('/charts/user-charts', name: "get_chart_by_user", methods: ["GET"])]
    public function getChartByUser(): JsonResponse
    {
        $user = $this->getUser();
        $charts = $this->chartService->getChartsByUser($user);
        $jsonCharts = $this->serializer->serialize($charts, 'json');
        return new JsonResponse(json_decode($jsonCharts, true));
    }

}
