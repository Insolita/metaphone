<?php

namespace tests;

use insolita\metaphone\filters\Normalize;
use PHPUnit\Framework\TestCase;

class NormalizeTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     * @param string $word
     * @param string $expected
     */
    public function testApply(string $word, string $expected):void
    {
        self::assertEquals($expected, (new Normalize())->apply($word));
    }

    public function dataProvider():array
    {
        return [
            'empty' => ['', ''],
            'latin' => ['foo', ''],
            'russian' => ['мама', 'мама'],
            'russian_yo' => ['ёлка', 'ёлка'],
            'russian_signs1' => ['лень', 'лен'],
            'russian_signs2' => ['подъезд', 'подезд'],
            'mixed' => ['fёkлоч3каj', 'ёлочка'],
            'capital' => ['КоШелЬ', 'кошел'],
            'spaces' => ['голубой вагон', 'голубойвагон'],
        ];
    }
}
