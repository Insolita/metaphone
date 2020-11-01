<?php

namespace tests;

use insolita\metaphone\filters\RemoveDoubleChars;
use PHPUnit\Framework\TestCase;

class RemoveDoubleCharsTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     * @param string $word
     * @param string $expected
     */
    public function testApply(string $word, string $expected):void
    {
        self::assertEquals($expected, (new RemoveDoubleChars())->apply($word));
    }

    public function dataProvider():array
    {
        return [
            'empty' => ['', ''],
            'latin' => ['foo', 'fo'],
            'no doubles' => ['дубликатовнет', 'дубликатовнет'],
            'double_at_end' => ['грамм', 'грам'],
            'double_at_start' => ['ссора', 'сора'],
            'double_at_middle' => ['россия', 'росия'],
            'double_multiple' => ['миллиграмм', 'милиграм'],
            'double_triple' => ['аппарррратуррра', 'апаратура'],
        ];
    }
}
