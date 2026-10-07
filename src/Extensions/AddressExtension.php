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
        'Горкі', 'Лунінец', 'Смаргонь', 'Пружаны', 'Паставы', 'Мар\'іна Горка', 'Ваўкавыск',
        'Бяроза', 'Крычаў', 'Іўе', 'Глыбокае',
    ];

    protected $streetTypes = ['вул.', 'пр-т', 'зав.', 'пл.', 'бул.'];

    // Genitive names agree with every street type.
    protected $streetNames = [
        'Незалежнасці', 'Перамогі', 'Міру', 'Свабоды', 'Будаўнікоў', 'Касманаўтаў',
        'Янкі Купалы', 'Якуба Коласа', 'Максіма Багдановіча', 'Францыска Скарыны', 'Каліноўскага', 'Машэрава',
        'Цёткі', 'Кузьмы Чорнага', 'Максіма Танка', 'Уладзіміра Караткевіча', 'Ефрасінні Полацкай',
        'Мележа', 'Васіля Быкава', 'Янкі Брыля', 'Францішка Багушэвіча', 'Адама Міцкевіча', 'Алеся Гаруна',
        'Пімена Панчанкі', 'Алеся Адамовіча', 'Станіслава Манюшкі', 'Ігната Дамейкі', 'Марка Шагала',
        'Язэпа Драздовіча', 'Усяслава Чарадзея', 'Льва Сапегі', 'Тадэвуша Касцюшкі', 'Петруся Броўкі',
        'Міхася Лынькова', 'Кандрата Крапівы', 'Пятра Глебкі', 'Івана Шамякіна', 'Янкі Маўра', 'Цішкі Гартнага',
        'Паўлюка Труса', 'Элізы Ажэшкі',
    ];

    // Feminine adjectives agree only with "вуліца".
    protected $streetAdjectiveNames = [
        'Савецкая', 'Чыгуначная', 'Сонечная', 'Цэнтральная', 'Садовая', 'Школьная', 'Лясная', 'Палявая',
        'Маладзёжная', 'Паштовая', 'Набярэжная', 'Зялёная', 'Тэатральная', 'Універсітэцкая', 'Замкавая',
        'Мастовая', 'Кальварыйская', 'Зыбіцкая', 'Старажоўская',
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
        $name = $this->pickArrayRandomElement(array_merge($this->streetNames, $this->streetAdjectiveNames));
        $streetType = in_array($name, $this->streetAdjectiveNames, true)
            ? 'вул.'
            : $this->pickArrayRandomElement($this->streetTypes);

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
