<?php

namespace Xefi\Faker\BeBy\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^BY\d{2}[A-Z]{4}\d{20}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
        }
    }
}
