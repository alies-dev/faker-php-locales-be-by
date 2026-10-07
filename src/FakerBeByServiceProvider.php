<?php

namespace Xefi\Faker\BeBy;

use Xefi\Faker\BeBy\Extensions\AddressExtension;
use Xefi\Faker\BeBy\Extensions\ColorsExtension;
use Xefi\Faker\BeBy\Extensions\CompanyExtension;
use Xefi\Faker\BeBy\Extensions\FinancialExtension;
use Xefi\Faker\BeBy\Extensions\PersonExtension;
use Xefi\Faker\BeBy\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerBeByServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            TextExtension::class,
        ]);
    }
}
