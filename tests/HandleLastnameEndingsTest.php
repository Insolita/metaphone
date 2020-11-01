<?php

namespace tests;

use insolita\metaphone\filters\HandleLastnameEndings;
use PHPUnit\Framework\TestCase;

class HandleLastnameEndingsTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     * @param string $word
     * @param string $expected
     */
    public function testApply(string $word, string $expected):void
    {
        self::assertEquals($expected, (new HandleLastnameEndings())->apply($word));
    }

    public function dataProvider():array
    {
        return [
            'empty' => ['', ''],
            'latin' => ['foo', 'foo'],
            'not lastname' => ['нефамилия', 'нефамилия'],
            '@' => ['дубровский', 'дубр@'],
            '#' => ['раневский', 'ран#'],
            '$' => ['петровская', 'петр$'],
            '%' => ['чернышевская', 'черныш%'],
            '0_1' => ['бондарчук', 'бондарч0'],
            '0_2' => ['федюк', 'фед0'],
            '1' => ['маринина', 'марин1'],
            '2_1' => ['горелик', 'горел2'],
            '2_2' => ['белек', 'бел2'],
            '3' => ['кириленко', 'кириле3'],
            '4_1' => ['нагиев', 'наг4'],
            '4_2' => ['киреев', 'кир4'],
            '4_3' => ['комаров', 'комар4'],
            '4_4' => ['супонев', 'супон4'],
            '5_1' => ['седых', 'сед5'],
            '5_2' => ['долгих', 'долг5'],
            '6' => ['светличная', 'светличн6'],
            '7_1' => ['навальный', 'навальн7'],
            '7_2' => ['палий', 'пал7'],
            '8_1' => ['нагиева', 'наг8'],
            '8_2' => ['киреева', 'кир8'],
            '8_3' => ['комарова', 'комар8'],
            '8_4' => ['ковалева', 'ковал8'],
            '9' => ['березин', 'берез9'],
        ];
    }
}
