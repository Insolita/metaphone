<?php

namespace tests;

use insolita\metaphone\filters\Replacements;
use PHPUnit\Framework\TestCase;

class ReplacementsTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $word
     * @param string $expected
     */
    public function testApply(string $word, string $expected):void
    {
        self::assertEquals($expected, (new Replacements())->apply($word));
    }

    public function dataProvider():array
    {
        return [
            'empty' => ['', ''],
            'latin' => ['foo', 'foo'],
            'тс' => ['крадётся', 'крадица'],
            'дс' => ['безрассудство', 'бизрассуцтва'],
            'укр_и' => ['переїзд', 'пириизд'],
            'укр_е' => ['підприємство', 'пидпримства'],
            'йо' => ['майонез', 'маиниз'],
            'ио' => ['физиотерапия', 'физитирапиа'],
            'йе' => ['йемен', 'имин'],
            'ие' => ['приключение', 'приклучини'],
            'оыя' => ['кошка', 'кашка'],
            'ю' => ['люстра', 'лустра'],
            'еёэ' => ['электричество', 'иликтричиства'],
        ];
    }
}