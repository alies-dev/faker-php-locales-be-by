<?php

namespace Xefi\Faker\BeBy\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
{
    private const array UNP_WEIGHTS = [29, 23, 19, 17, 13, 7, 5, 3];

    public function getLocale(): string|null
    {
        return 'be_BY';
    }

    private array $companies = [
        'ТАА «Заранка-Плюс»', 'ААТ «Нёманпрам»', 'ЗАТ «Палессе-Інвест»', 'ПУП «Лясны край»', 'УП «Белагродар»',
        'ТАА «Сонечны Бераг»', 'ААТ «Дняпроўскі завод»', 'ТАА «Мінскбудсервіс»', 'ПУП «Княжыца»',
        'ТАА «Верасень-Трэйд»', 'УП «Сямейны хлеб»', 'ТАА «Лагойская ніва»', 'ААТ «Заходнебуд»',
        'ЗАТ «Радзіма-Агра»', 'ТАА «Космас-Інфа»', 'ПУП «Крынічка»', 'ТАА «Данабуд»', 'ААТ «Бярозаўскі камбінат»',
        'ТАА «Ніва-Тэх»', 'УП «Прыбярэжны»', 'ТАА «Рунь-Груп»', 'ПУП «Вішнёвы сад»', 'ЗАТ «Нарач-Сэрвіс»',
        'ТАА «Прамень-Лагістык»', 'ААТ «Свіслач-Маш»', 'ТАА «Віцебская мануфактура»', 'ПУП «Купалінка»',
        'ТАА «Беларуская сыравіна»', 'УП «Мінскдарсервіс»', 'ТАА «Паўночны вецер»',
    ];

    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Payer account number (УНП) of a legal entity: 9 digits, the last one a weighted mod 11 check digit.
     */
    public function unp(): string
    {
        do {
            $digits = (string) $this->randomizer->getInt(1, 7) . $this->formatString(str_repeat('{d}', 7));

            $sum = 0;
            foreach (self::UNP_WEIGHTS as $i => $weight) {
                $sum += $weight * (int) $digits[$i];
            }

            $check = $sum % 11;
        } while ($check === 10);

        return $digits . $check;
    }
}
