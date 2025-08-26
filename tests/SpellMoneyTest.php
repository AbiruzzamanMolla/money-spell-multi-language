<?php

use AzMolla\SpellMoney\Languages\Arabic;
use AzMolla\SpellMoney\Languages\Bangla;
use AzMolla\SpellMoney\Languages\Chinese;
use AzMolla\SpellMoney\Languages\English;
use AzMolla\SpellMoney\Languages\Hindi;
use AzMolla\SpellMoney\Languages\Japanese;
use AzMolla\SpellMoney\Languages\Thai;
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

    public function testHindi()
    {
        $spell = new SpellMoney(new Hindi());
        $this->assertStringContainsString('रुपये', $spell->spell("१२३"));
    }

    public function testChinese()
    {
        $spell = new SpellMoney(new Chinese());
        $this->assertStringContainsString('元', $spell->spell("１２３"));
    }

    public function testThai()
    {
        $spell = new SpellMoney(new Thai());
        $this->assertStringContainsString('บาท', $spell->spell("๑๒๓"));
    }

    public function testArabic()
    {
        $spell = new SpellMoney(new Arabic());
        $this->assertStringContainsString('جنيه', $spell->spell("١٢٣"));
    }

    public function testJapanese()
    {
        $spell = new SpellMoney(new Japanese());
        $this->assertStringContainsString('円', $spell->spell("123"));
    }
}
