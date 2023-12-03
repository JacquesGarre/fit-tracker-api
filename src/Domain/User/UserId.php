<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

use EventSauce\EventSourcing\AggregateRootId;

final class UserId implements AggregateRootId
{
    private function __construct(private string $id)
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        return $this->id;
    }

    public static function fromString(string $id): static
    {
        return new static($id);
    }
}
