<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use FitTrackerApi\Domain\DomainEvents\UserInitiated;

final class User implements AggregateRoot
{
    use AggregateRootBehaviour;

    public static function initiate(UserId $id): User
    {
        $process = new static($id);
        $process->recordThat(new UserInitiated($id));
        return $process;
    }

    public static function applyUserInitiated(): void
    {
    }
}
