<?php

namespace Xefi\Faker\BeBy\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\BeBy\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameFemale, $results);
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameMale, $results);
    }

    public function testLastNameMale(): void
    {
        $masculine = array_keys($this->lastName);

        $results = [];
        for ($i = 0; $i < count($masculine); $i++) {
            $results[] = $this->faker->unique()->lastName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($masculine, $results);
    }

    public function testLastNameFemale(): void
    {
        $feminine = array_unique(array_values($this->lastName));

        $results = [];
        for ($i = 0; $i < count($feminine); $i++) {
            $results[] = $this->faker->unique()->lastName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($feminine, $results);
    }

    public function testNameMaleUsesMasculineForms(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_MALE), 2);

            $this->assertContains($firstName, $this->firstNameMale);
            $this->assertArrayHasKey($lastName, $this->lastName);
        }
    }

    public function testNameFemaleUsesFeminineForms(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_FEMALE), 2);

            $this->assertContains($firstName, $this->firstNameFemale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameKeepsGenderConsistent(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(), 2);

            $this->assertContains(
                $lastName,
                in_array($firstName, $this->firstNameMale, true) ? array_keys($this->lastName) : array_values($this->lastName),
                "'{$firstName} {$lastName}' mixes genders."
            );
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->titleFemale, $results);
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->titleMale, $results);
    }
}
