<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Architecture;

use Exception;
use FitTrackerApi\Domain\User\UserRepositoryInterface;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class ProjectArchitectureTest
{
    public function testDomainShouldBeIndependent(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('FitTrackerApi\Domain'))
            ->canOnlyDependOn()
            ->classes(
                Selector::inNamespace('FitTrackerApi\Domain'),
                Selector::inNamespace('EventSauce\EventSourcing'),
                Selector::classname(Exception::class),
                Selector::inNamespace('Ramsey\Uuid')
            )
            ->because('Domain should be independent');
    }

    public function testDomainShouldBeFinal(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('FitTrackerApi\Domain')
            )
            ->excluding(
                Selector::classname(UserRepositoryInterface::class)
            )
            ->shouldBeFinal();
    }

    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('FitTrackerApi\Domain'))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('FitTrackerApi\Application'),
                Selector::inNamespace('FitTrackerApi\Infrastructure'),
            )
            ->because('Domain should not depend on other layers');
    }

    public function testApplicationDoesNotDependOnInfra(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('FitTrackerApi\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('FitTrackerApi\Infrastructure'))
            ->because('Application should not depend on infrastructure layer');
    }
}
