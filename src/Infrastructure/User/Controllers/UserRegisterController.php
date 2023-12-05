<?php

declare(strict_types=1);

namespace FitTrackerApi\Infrastructure\User\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use FitTrackerApi\Infrastructure\User\Actions\RegisterUserAction;

class UserRegisterController extends AbstractController
{
    public function __construct(private RegisterUserAction $action)
    {
    }

    #[Route(path: '/v1/register', name: 'user_register')]
    public function __invoke(Request $request): JsonResponse
    {
        ($this->action)($request);
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
