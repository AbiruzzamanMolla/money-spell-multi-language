<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class Japanese implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [
        0 => "零",
        1 => "一",
        2 => "二",
        3 => "三",
        4 => "四",
        5 => "五",
        6 => "六",
        7 => "七",
        8 => "八",
        9 => "九",
    ];

    /**
     * @var array
     */
    private $scales = [
        10        => "十",
        100       => "百",
        1000      => "千",
        10000     => "万",
        100000000 => "億",
    ];

    /**
     * Normalize numbers (Japanese uses standard digits too)
     */
    public function normalizeNumber(string $number): string
    {
        // Convert fullwidth digits to standard 0-9
        $fullwidth = ['０', '１', '２', '３', '４', '５', '６', '７', '８', '９'];
        $halfwidth = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($fullwidth, $halfwidth, $number);
    }

    /**
     * Convert integer number to words
     */
    public function toWords(int $num): string
    {
        if ($num === 0) {
            return $this->digits[0];
        }

        $result = '';

        foreach (array_reverse($this->scales, true) as $value => $label) {
            if ($num >= $value) {
                $count = intdiv($num, $value);
                $rem   = $num % $value;

                if ($value >= 10000 && $count > 1) {
                    $result .= $this->toWords($count) . $label;
                } elseif ($value >= 10 && $count > 1) {
                    $result .= $this->digits[$count] . $label;
                } else {
                    $result .= $label;
                }

                if ($rem) {
                    $result .= $this->toWords($rem);
                }

                return $result;
            }
        }

        return $this->digits[$num] ?? '';
    }

    public function getCurrency(): string
    {
        return "円";
    }

    public function getSubCurrency(): string
    {
        return "銭"; // rare, but for sub-units
    }
}
