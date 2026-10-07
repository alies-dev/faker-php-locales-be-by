<?php

namespace Xefi\Faker\BeBy\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    public function getLocale(): string|null
    {
        return 'be_BY';
    }

    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'BY';
        }

        if ($format === null) {
            // Bank code (4 letters), balance account (4 digits), account number (16 characters)
            $format = str_repeat('{l}', 4) . str_repeat('{d}', 20);
        }

        return parent::iban($countryCode, $format);
    }
}
