<?php

declare(strict_types=1);

namespace FitTrackerApi\Shared\Infrastructure\Bus\Command;

use FitTrackerApi\Shared\Domain\Bus\Command\Command;
use FitTrackerApi\Shared\Domain\Bus\Command\CommandBus;
use InvalidArgumentException;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use FitTrackerApi\Shared\Infrastructure\Bus\HandlerBuilder;

final class InMemoryCommandBus implements CommandBus
{
    private MessageBus $bus;

    public function __construct(
        iterable $commandHandlers
    ) {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(
                    HandlerBuilder::fromCallables($commandHandlers),
                ),
            ),
        ]);
    }

    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}
