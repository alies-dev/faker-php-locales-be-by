<?php

namespace Xefi\Faker\BeBy\Tests\Unit;

use Xefi\Faker\Container\Container;
use Xefi\Faker\BeBy\FakerBeByServiceProvider;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Container $faker;

    protected function setUp(): void
    {
        Container::packageManifestPath('/tmp/packages.php');

        (new FakerBeByServiceProvider())->boot();

        $this->faker = (new Container(false))->locale('be_BY');
    }
}
