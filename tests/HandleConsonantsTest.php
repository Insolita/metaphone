<?php

namespace tests;

use insolita\metaphone\filters\HandleConsonants;
use PHPUnit\Framework\TestCase;

class HandleConsonantsTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $word
     * @param string $expected
     * @param bool   $skipBeforeResonant
     */
    public function testApply(string $word, string $expected, bool $skipBeforeResonant):void
    {
        self::assertEquals($expected, (new HandleConsonants($skipBeforeResonant))->apply($word));
    }

    public function dataProvider():array
    {
        return [
            'empty' => ['', '', false],
            ['давка', 'дафка', false],
            ['обнимать', 'опнимать', false],
            ['сбросить', 'спросить', false],
            ['сбросить', 'сбросить', true],
            ['дерево', 'дерево', false],
            ['город', 'горот', false],
            ['городить', 'городить', false],
            ['зуб', 'зуп', false],
            ['сказка', 'скаска', false],
            ['мороз', 'морос', false],
            ['бумажка', 'бумашка', false],
            ['бумажка', 'бумашка', true],
        ];
    }
}