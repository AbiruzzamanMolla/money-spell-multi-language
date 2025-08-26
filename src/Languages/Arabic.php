<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class Arabic implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [0 => "صفر", 1 => "واحد", 2 => "اثنان", 3  => "ثلاثة", 4 => "أربعة", 5 => "خمسة",
        6                    => "ستة", 7 => "سبعة", 8 => "ثمانية", 9 => "تسعة", 10 => "عشرة", 11 => "أحد عشر", 12 => "اثنا عشر"];
    /**
     * @var array
     */
    private $tens = [20 => "عشرون", 30 => "ثلاثون", 40 => "أربعون", 50 => "خمسون",
        60                  => "ستون", 70  => "سبعون", 80  => "ثمانون", 90 => "تسعون"];
    /**
     * @var array
     */
    private $scales = [100 => "مائة", 1000 => "ألف", 1000000 => "مليون", 1000000000 => "مليار"];

    /**
     * @param string $number
     */
    public function normalizeNumber(string $number): string
    {
        $ar = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($ar, $en, $number);
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

        if ($num < 13) {
            return $this->digits[$num];
        }

        if ($num < 100) {
            $t = intdiv($num, 10) * 10;
            $u = $num % 10;
            return ($u ? $this->digits[$u] . ' ' : '') . $this->tens[$t];
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
    {return "جنيه";}
    public function getSubCurrency(): string
    {return "قرش";}
}
