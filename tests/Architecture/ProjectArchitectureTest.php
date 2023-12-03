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
            ->classes(Selector::namespace('FitTrackerApi\Domain'))
            ->canOnlyDependOn()
            ->classes(Selector::namespace('FitTrackerApi\Domain'))
            ->because('this will break ddd architecture');
    }

    public function testDomainShouldBeFinal(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::namespace('FitTrackerApi\Domain'))
            ->shouldBeFinal();
    }

    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::namespace('FitTrackerApi\Domain'))
            ->shouldNotDependOn()
            ->classes(
                Selector::namespace('FitTrackerApi\Application'),
                Selector::namespace('FitTrackerApi\Infrastructure'),
            )
            ->because('this will break ddd architecture');
    }

    public function testApplicationDoesNotDependOnInfra(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::namespace('FitTrackerApi\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::namespace('FitTrackerApi\Infrastructure'))
            ->because('this will break ddd architecture');
    }

}