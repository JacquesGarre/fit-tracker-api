<?php

declare(strict_types=1);

namespace FitTrackerApi\Infrastructure\User\Actions;

use FitTrackerApi\Application\User\RegisterUserCommand;
use FitTrackerApi\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserAction
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    public function __invoke(Request $request): void
    {
        $content = json_decode($request->getContent(), true);
        $this->commandBus->dispatch(
            new RegisterUserCommand(
                id: $content['id'],
                email: $content['email'],
                password: $content['password'],
            ),
        );
    }
}
