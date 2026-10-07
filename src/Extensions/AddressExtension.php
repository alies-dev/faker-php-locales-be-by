<?php

namespace Xefi\Faker\BeBy\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    public function getLocale(): string|null
    {
        return 'be_BY';
    }

    protected $regions = [
        'Брэсцкая вобласць', 'Віцебская вобласць', 'Гомельская вобласць', 'Гродзенская вобласць',
        'Мінская вобласць', 'Магілёўская вобласць', 'Мінск',
    ];

    protected $cities = [
        'Мінск', 'Гомель', 'Магілёў', 'Віцебск', 'Гродна', 'Брэст', 'Бабруйск', 'Баранавічы', 'Барысаў', 'Пінск',
        'Орша', 'Мазыр', 'Салігорск', 'Наваполацк', 'Ліда', 'Маладзечна', 'Полацк', 'Жлобін', 'Светлагорск',
        'Рэчыца', 'Слуцк', 'Жодзіна', 'Кобрын', 'Слонім', 'Вілейка', 'Навагрудак', 'Калінкавічы', 'Асіповічы',
        'Горкі', 'Лунінец', 'Смаргонь', 'Пружаны', 'Дзяржынск', 'Паставы', 'Мар\'іна Горка', 'Ваўкавыск',
        'Бяроза', 'Крычаў', 'Іўе', 'Глыбокае',
    ];

    protected $streetTypes = ['вул.', 'пр-т', 'зав.', 'пл.', 'бул.'];

    // Genitive names only: an adjective name ("Садовая") would have to agree with the street type's gender.
    protected $streetNames = [
        'Леніна', 'Янкі Купалы', 'Якуба Коласа', 'Максіма Багдановіча', 'Незалежнасці', 'Перамогі', 'Міра',
        'Францыска Скарыны', 'Кірава', 'Карла Маркса', 'Фрунзе', 'Горкага', 'Гагарына', 'Пушкіна', 'Талстога',
        'Чкалава', 'Каліноўскага', 'Багдана Хмяльніцкага', 'Ясеніна', 'Свярдлова', 'Машэрава', 'Сурганава',
        'Цёткі', 'Кузьмы Чорнага', 'Максіма Танка', 'Уладзіміра Караткевіча', 'Ефрасінні Полацкай', 'Мележа',
        'Някрасава', 'Энгельса', 'Дзяржынскага', 'Суворава', 'Кутузава', 'Лермантава', 'Гогаля',
    ];

    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    public function city(): string
    {
        return $this->pickArrayRandomElement($this->cities);
    }

    public function postcode(): int
    {
        return $this->randomizer->getInt(210000, 247999);
    }

    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 300);
    }

    public function streetName(): string
    {
        $streetType = $this->pickArrayRandomElement($this->streetTypes);
        $name = $this->pickArrayRandomElement($this->streetNames);

        return sprintf('%s %s', $streetType, $name);
    }

    public function streetAddress(): string
    {
        return sprintf('%s, %d', $this->streetName(), $this->houseNumber());
    }

    public function fullAddress(): string
    {
        return sprintf('%s, %d, %s', $this->streetAddress(), $this->postcode(), $this->city());
    }
}
