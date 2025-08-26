<?php

namespace AzMolla\SpellMoney\Contracts;

interface LanguageInterface
{
    /**
     * @param string $number
     */
    public function normalizeNumber(string $number): string;

    public function toWords(int $number): string;

    public function getCurrency(): string;

    public function getSubCurrency(): string;
}
