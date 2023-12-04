<?php

declare(strict_types=1);

namespace FitTrackerApi\Domain\User;

use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId implements AggregateRootId
{
    private function __construct(private UuidInterface $id)
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        return $this->id->toString();
    }

    public static function fromString(string $id): static
    {
        $uuid = Uuid::fromString($id);
        return new static($uuid);
    }
}
