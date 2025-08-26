<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class Chinese implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [0 => "零", 1 => "一", 2 => "二", 3 => "三", 4  => "四", 5 => "五",
        6                    => "六", 7 => "七", 8 => "八", 9 => "九", 10 => "十"];
    /**
     * @var array
     */
    private $scales = [100 => "百", 1000 => "千", 10000 => "万", 100000000 => "亿"];

    /**
     * @param string $number
     */
    public function normalizeNumber(string $number): string
    {
        $cn = ['０', '１', '２', '３', '４', '５', '６', '７', '８', '９'];
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($cn, $en, $number);
    }

    /**
     * @param int $num
     * @return mixed
     */
    public function toWords(int $num): string
    {
        if ($num == 0) {
            return $this->digits[0];
        }

        if ($num < 11) {
            return $this->digits[$num];
        }

        foreach (array_reverse($this->scales, true) as $value => $label) {
            if ($num >= $value) {
                $count = intdiv($num, $value);
                $rem   = $num % $value;
                $out   = $this->toWords($count) . $label;
                if ($rem) {
                    $out .= $this->toWords($rem);
                }

                return $out;
            }
        }
        return '';
    }

    public function getCurrency(): string
    {return "元";}
    public function getSubCurrency(): string
    {return "分";}
}
