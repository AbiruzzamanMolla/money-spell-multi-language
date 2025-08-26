<?php

namespace AzMolla\SpellMoney\Languages;

use AzMolla\SpellMoney\Contracts\LanguageInterface;

class Thai implements LanguageInterface
{
    /**
     * @var array
     */
    private $digits = [0 => "ศูนย์", 1 => "หนึ่ง", 2 => "สอง", 3 => "สาม", 4   => "สี่", 5 => "ห้า",
        6                    => "หก", 7    => "เจ็ด", 8  => "แปด", 9 => "เก้า", 10 => "สิบ"];
    /**
     * @var array
     */
    private $scales = [100 => "ร้อย", 1000 => "พัน", 10000 => "หมื่น", 100000 => "แสน", 1000000 => "ล้าน"];

    /**
     * @param string $number
     */
    public function normalizeNumber(string $number): string
    {
        $thai = ['๐', '๑', '๒', '๓', '๔', '๕', '๖', '๗', '๘', '๙'];
        $eng  = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($thai, $eng, $number);
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
    {return "บาท";}
    public function getSubCurrency(): string
    {return "สตางค์";}
}
