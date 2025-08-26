<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class English implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [0 => "zero", 1      => "one", 2       => "two", 3      => "three", 4    => "four", 5 => "five",
        6                    => "six", 7       => "seven", 8     => "eight", 9    => "nine", 10    => "ten", 11 => "eleven", 12 => "twelve",
        13                   => "thirteen", 14 => "fourteen", 15 => "fifteen", 16 => "sixteen", 17 => "seventeen",
        18                   => "eighteen", 19 => "nineteen"];
    /**
     * @var array
     */
    private $tens = [20 => "twenty", 30  => "thirty", 40 => "forty", 50 => "fifty", 60 => "sixty",
        70                  => "seventy", 80 => "eighty", 90 => "ninety"];
    /**
     * @var array
     */
    private $scales = [100 => "hundred", 1000 => "thousand", 1000000 => "million", 1000000000 => "billion"];

    /**
     * @param string $number
     * @return mixed
     */
    public function normalizeNumber(string $number): string
    {return $number;}

    /**
     * @param int $num
     * @return mixed
     */
    public function toWords(int $num): string
    {
        if ($num == 0) {
            return $this->digits[0];
        }

        if ($num < 20) {
            return $this->digits[$num];
        }

        if ($num < 100) {
            $t = intdiv($num, 10) * 10;
            $u = $num % 10;
            return $this->tens[$t] . ($u ? ' ' . $this->digits[$u] : '');
        }
        foreach (array_reverse($this->scales, true) as $value => $label) {
            if ($num >= $value) {
                $count = intdiv($num, $value);
                $rem   = $num % $value;
                $out   = $this->toWords($count) . ' ' . $label;
                if ($rem) {
                    $out .= ' ' . $this->toWords($rem);
                }

                return $out;
            }
        }
        return '';
    }

    public function getCurrency(): string
    {return "taka";}
    public function getSubCurrency(): string
    {return "paisa";}
}
