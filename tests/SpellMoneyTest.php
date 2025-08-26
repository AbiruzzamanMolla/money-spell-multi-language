<?php

use AzMolla\SpellMoney\Languages\Bangla;
use AzMolla\SpellMoney\Languages\English;
use AzMolla\SpellMoney\SpellMoney;
use PHPUnit\Framework\TestCase;

class SpellMoneyTest extends TestCase
{
    public function testBangla()
    {
        $spell = new SpellMoney(new Bangla());
        $this->assertStringContainsString('টাকা', $spell->spell("১২৩"));
    }

    public function testEnglish()
    {
        $spell = new SpellMoney(new English());
        $this->assertStringContainsString('taka', $spell->spell(123));
    }
}
