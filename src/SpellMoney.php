<?php

namespace AzMolla\SpellMoney;

use AzMolla\SpellMoney\Contracts\LanguageInterface;
use AzMolla\SpellMoney\Languages\Bangla;

class SpellMoney
{
    private LanguageInterface $language;

    /**
     * @param LanguageInterface $language
     */
    public function __construct(?LanguageInterface $language = null)
    {
        $this->language = $language ?? new Bangla();
    }

    /**
     * @param $number
     */
    public function spell($number): string
    {
        $number = $this->language->normalizeNumber((string) $number);

        $parts   = explode('.', number_format((float) $number, 2, '.', ''));
        $integer = (int) $parts[0];
        $decimal = (int) $parts[1];

        $words = $this->language->toWords($integer) . ' ' . $this->language->getCurrency();
        if ($decimal > 0) {
            $words .= ' ' . $this->language->toWords($decimal) . ' ' . $this->language->getSubCurrency();
        }
        return trim($words);
    }

    /**
     * @param $number
     */
    public static function convert($number, ?LanguageInterface $language = null): string
    {
        return (new SpellMoney($language))->spell($number);
    }
}
