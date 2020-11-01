<?php

namespace tests;

use insolita\metaphone\Metaphone;
use PHPUnit\Framework\TestCase;

class MetaphoneTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     * @param string $word
     * @param string $expected
     */
    public function testProcessWord(string $word, string $expected):void
    {
        $metaphone = new Metaphone();
        self::assertEquals($expected, $metaphone->processWord($word));
    }

    /**
     * @dataProvider dataProvider2
     * @param string $word
     * @param string $expected
     */
    public function testProcessWordSkipLastnames(string $word, string $expected):void
    {
        $metaphone = (new Metaphone())->skipLastnames();
        self::assertEquals($expected, $metaphone->processWord($word));
    }

    public function dataProvider()
    {
        return [
            'empty' => ['', ''],
            ['вода', 'вада'],
            ['водица', 'вадица'],
            ['водичка', 'вадичка'],
            ['сертификат', 'сиртификат'],
            ['абсурд', 'апсурт'],
            ['садиться', 'садица'],
            ['подъезд', 'падизт'],
            ['пельмени', 'пилмини'],
            ['медальон', 'мидалан'],
            ['бульон', 'булан'],
            ['клён', 'клин'],
            ['яблоко', 'аплака'],
            ['дубликат', 'дупликат'],
            ['колосс', 'калас'],
            ['Чернышевский', 'чирнаш#'],
            ['Брагилевский', 'прагил#'],
            ['Иванова', 'иван8'],
            ['Каменская', 'каминск6'],
            ['Каминских', 'каминск5'],
            ['королева', 'карал8'],
            ['королёва', 'карал8'],
        ];
    }

    public function dataProvider2()
    {
        return [
            ['колоссальный', 'каласалнай'],
            ['Чернышевский', 'чирнашифский'],
            ['Брагилевский', 'прагилифский'],
            ['Иванова', 'иванава'],
            ['Каменская', 'каминска'],
            ['Каминская', 'каминска'],
            ['Каминских', 'каминских'],
            ['королева', 'каралива'],
            ['королёва', 'каралива'],
        ];
    }
}
