# Spell Money (Multilingual)

[![Latest Stable Version](https://poser.pugx.org/azmolla/spell-money-multilang/v)](https://packagist.org/packages/azmolla/spell-money-multilang)
[![License](https://poser.pugx.org/azmolla/spell-money-multilang/license)](https://packagist.org/packages/azmolla/spell-money-multilang)
[![PHP Version Require](https://poser.pugx.org/azmolla/spell-money-multilang/require/php)](https://packagist.org/packages/azmolla/spell-money-multilang)
[![Tests](https://github.com/AbiruzzamanMolla/money-spell-multi-language/actions/workflows/tests.yml/badge.svg)](https://github.com/AbiruzzamanMolla/money-spell-multi-language/actions)

Convert numbers into words for money amounts across multiple languages.
Currently supports **Bangla, English, Hindi, Chinese, Thai, and Arabic**, with proper numeral recognition.
Designed to be easily extendable so you can add new languages.

---

## Installation

Install via Composer:

```bash
composer require azmolla/spell-money-multilang
```

---

## Usage

```php
use AzMolla\SpellMoney\SpellMoney;
use AzMolla\SpellMoney\Languages\Bangla;
use AzMolla\SpellMoney\Languages\English;
use AzMolla\SpellMoney\Languages\Hindi;
use AzMolla\SpellMoney\Languages\Chinese;
use AzMolla\SpellMoney\Languages\Thai;
use AzMolla\SpellMoney\Languages\Arabic;

// Bangla (default)
$spell = new SpellMoney(new Bangla());
echo $spell->spell("১২৩৪৫.৫০");
// বারো হাজার তিন শত পঁইতাল্লিশ টাকা পঞ্চাশ পয়সা

// English
$spell = new SpellMoney(new English());
echo $spell->spell(12345.50);
// twelve thousand three hundred forty five taka fifty paisa

// Hindi
$spell = new SpellMoney(new Hindi());
echo $spell->spell("१२३४५.५०");
// बारह हज़ार तीन सौ पैंतालीस रुपये पचास पैसा

// Chinese
$spell = new SpellMoney(new Chinese());
echo $spell->spell("１２３４５.５０");
// 一万二千三百四十五 元 五十 分

// Thai
$spell = new SpellMoney(new Thai());
echo $spell->spell("๑๒๓๔๕.๕๐");
// หนึ่งหมื่นสองพันสามร้อยสี่สิบห้า บาท ห้าสิบ สตางค์

// Arabic
$spell = new SpellMoney(new Arabic());
echo $spell->spell("١٢٣٤٥.٥٠");
// اثنا عشر ألف ثلاثمائة خمسة وأربعون جنيه خمسون قرش
```

### or

```php

use AzMolla\SpellMoney\SpellMoney;
use AzMolla\SpellMoney\Languages\Bangla;

SpellMoney::convert("12345.50", new Bangla());
```

---

## Supported Numeral Systems

| Language    | Digits Recognized    | Example Input  | Example Output                |
| ----------- | -------------------- | -------------- | ----------------------------- |
| **Bangla**  | ০–৯                  | `১২৩`          | এক শত তেইশ টাকা               |
| **Hindi**   | ०–९                  | `१२३`          | एक सौ तेईस रुपये              |
| **Arabic**  | ٠–٩                  | `١٢٣`          | مائة و ثلاثة و عشرون جنيه     |
| **Thai**    | ๐–๙                  | `๑๒๓`          | หนึ่งร้อยยี่สิบสาม บาท        |
| **Chinese** | ０–９ (fullwidth), 0–9 | `１２৩` or `123` | 一百二十三 元                       |
| **English** | 0–9                  | `123`          | one hundred twenty three taka |

> ✅ Both **local numerals** and **standard 0–9 digits** are supported.
> ✅ Each language normalizes its own digit system internally.

---

## Features

* Convert **numbers to money words** in multiple languages.
* Works with both **local numerals** and **standard digits**.
* Supports **integer + decimal amounts**.
* Currency and sub-currency names are language-specific:

  * Bangla → টাকা / পয়সা
  * Hindi → रुपये / पैसा
  * Arabic → جنيه / قرش
  * Chinese → 元 / 分
  * Thai → บาท / สตางค์
  * English → taka / paisa
* Easily extendable — just add a new `Language` class.

---

## Adding a New Language

1. Create a class in `src/Languages/`, for example `French.php`.
2. Implement the `LanguageInterface`.

```php
<?php
namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class French implements LanguageInterface
{
    public function normalizeNumber(string $number): string
    {
        return $number; // French uses Arabic numerals
    }

    public function toWords(int $num): string
    {
        // Implement French spelling here
        return "cent vingt-trois"; // 123
    }

    public function getCurrency(): string { return "euro"; }
    public function getSubCurrency(): string { return "centime"; }
}
```

3. Use it in code:

```php
$spell = new SpellMoney(new French());
echo $spell->spell(123.45);
// cent vingt-trois euro quarante-cinq centimes
```

---

## Demo

Clone the repo and run the demo:

```bash
php examples/demo.php
```

Example output:

```
[Bangla] বারো হাজার তিন শত পঁইতাল্লিশ টাকা পঞ্চাশ পয়সা
[English] twelve thousand three hundred forty five taka fifty paisa
[Hindi] बारह हज़ार तीन सौ पैंतालीस रुपये पचास पैसा
[Chinese] 一万二千三百四十五 元 五十 分
[Thai] หนึ่งหมื่นสองพันสามร้อยสี่สิบห้า บาท ห้าสิบ สตางค์
[Arabic] اثنا عشر ألف ثلاثمائة خمسة وأربعون جنيه خمسون قرش
```

---

## Running Tests

Install dependencies and run PHPUnit:

```bash
composer install
vendor/bin/phpunit tests
```

In VS Code, you can also run tests from the **Testing** tab if you have the **PHPUnit Test Explorer** extension installed.

---

## GitHub Actions CI

This package includes CI to run tests on **push** and **pull requests**.
See `.github/workflows/tests.yml`.

---

## Roadmap

* Expand irregular forms in Bangla/Hindi (একুশ, बाईस, etc.).
* Add more languages (French, Japanese, German, etc.).
* Accept community contributions 🎉.

---

## License

MIT © [Abiruzzaman Molla](https://github.com/AbiruzzamanMolla)