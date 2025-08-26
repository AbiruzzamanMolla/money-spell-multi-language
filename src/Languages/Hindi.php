<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class Hindi implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [0 => "शून्य", 1 => "एक", 2    => "दो", 3      => "तीन", 4   => "चार", 5    => "पांच",
        6                    => "छह", 7    => "सात", 8   => "आठ", 9      => "नौ", 10   => "दस", 11    => "ग्यारह", 12 => "बारह",
        13                   => "तेरह", 14 => "चौदह", 15 => "पंद्रह", 16 => "सोलह", 17 => "सत्रह", 18 => "अठारह", 19  => "उन्नीस"];
    /**
     * @var array
     */
    private $tens = [20 => "बीस", 30   => "तीस", 40   => "चालीस", 50 => "पचास", 60 => "साठ",
        70                  => "सत्तर", 80 => "अस्सी", 90 => "नब्बे"];
    /**
     * @var array
     */
    private $scales = [100 => "सौ", 1000 => "हज़ार", 100000 => "लाख", 10000000 => "करोड़"];

    /**
     * @param string $number
     */
    public function normalizeNumber(string $number): string
    {
        $hn = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($hn, $en, $number);
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
    {return "रुपये";}
    public function getSubCurrency(): string
    {return "पैसा";}
}
