# Faker PHP: Belarusian (be_BY) locale

Belarusian locale for [xefi/faker-php](https://github.com/xefi/faker-php). All data is in Belarusian (Cyrillic, official orthography).

The package is waiting to move under the xefi organization ([xefi/faker-php#94](https://github.com/xefi/faker-php/issues/94)). Until then it is not on Packagist, so install it from this repository.

## Installation

Add the repository to your `composer.json`:

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/alies-dev/faker-php-locales-be-by" }
    ]
}
```

Then require the package:

```bash
composer require --dev xefi/faker-php-locales-be-by:dev-main
```

The service provider is discovered automatically.

## Usage

```php
$faker = new Xefi\Faker\Faker('be_BY');

$faker->name(gender: 'F');   // Кацярына Шыманская
$faker->fullAddress();       // вул. Янкі Купалы, 28, 220030, Мінск
$faker->company();           // ТАА «Мінскбудсэрвіс»
$faker->unp();               // 292113015
$faker->iban();              // BY60XEPB01979826101994987820
$faker->colorName();         // Індыга
$faker->sentences(1);        // Наша кампанія прапаноўвае кліентам якасныя паслугі...
```

## What is included

| Extension | Methods |
|---|---|
| Address | `region`, `city`, `postcode`, `houseNumber`, `streetName`, `streetAddress`, `fullAddress` |
| Colors | `safeColorName`, `colorName` |
| Company | `company`, `unp` (payer account number with a valid check digit) |
| Financial | `iban` (28 characters, BY format) |
| Person | `name`, `firstName`, `lastName`, `title` |
| Text | `words`, `sentences`, `paragraphs` |

Belarusian surnames often change with gender (Кавалёў, Кавалёва; Жылінскі, Жылінская). `name()` and `lastName()` always return the form that matches the gender.

## Testing

```bash
composer install
vendor/bin/phpunit
```

## License

MIT
