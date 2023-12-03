<?php

declare(strict_types=1);

namespace FitTrackerApi\Tests\Architecture;

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
                Selector::inNamespace('EventSauce\EventSourcing')
            )
            ->because('this will break ddd architecture');
    }

    public function testDomainShouldBeFinal(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('FitTrackerApi\Domain'))
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
            ->because('this will break ddd architecture');
    }

    public function testApplicationDoesNotDependOnInfra(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('FitTrackerApi\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('FitTrackerApi\Infrastructure'))
            ->because('this will break ddd architecture');
    }
}
