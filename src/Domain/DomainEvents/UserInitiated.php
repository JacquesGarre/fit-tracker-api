<?php

namespace FitTrackerApi\Domain\DomainEvents;

use EventSauce\EventSourcing\Serialization\SerializablePayload;
use FitTrackerApi\Domain\User\UserId;

final class UserInitiated implements SerializablePayload
{
    public function __construct(private readonly UserId $id)
    {
    }

    public function toPayload(): array
    {
        return ['id' => $this->id];
    }

    public static function fromPayload(array $payload): static
    {
        return new static($payload['id']);
    }
}
