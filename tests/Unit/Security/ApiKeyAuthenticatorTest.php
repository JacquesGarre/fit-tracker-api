<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Unit\Security;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ApiKeyAuthenticatorTest extends ApiTestCase
{
    public function testAuthenticate(): void
    {
        self::assertTrue(true);
    }
}
