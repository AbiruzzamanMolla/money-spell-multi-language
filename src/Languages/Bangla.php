<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class Bangla implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [
        0  => "শূন্য", 1  => "এক", 2     => "দুই", 3    => "তিন", 4    => "চার",
        5  => "পাঁচ", 6   => "ছয়", 7    => "সাত", 8    => "আট", 9     => "নয়",
        10 => "দশ", 11    => "এগারো", 12 => "বারো", 13  => "তেরো", 14  => "চৌদ্দ",
        15 => "পনেরো", 16 => "ষোল", 17   => "সতেরো", 18 => "আঠারো", 19 => "উনিশ",
    ];

    /**
     * @var array
     */
    private $tens = [
        20 => "বিশ", 30 => "ত্রিশ", 40 => "চল্লিশ", 50 => "পঞ্চাশ",
        60 => "ষাট", 70 => "সত্তর", 80 => "আশি", 90    => "নব্বই",
    ];

    /**
     * @var array
     */
    private $scales = [100 => "শত", 1000 => "হাজার", 100000 => "লাখ", 10000000 => "কোটি"];

    /**
     * @param string $number
     */
    public function normalizeNumber(string $number): string
    {
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($bn, $en, $number);
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
    {return "টাকা";}
    public function getSubCurrency(): string
    {return "পয়সা";}
}
