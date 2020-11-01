<?php

namespace insolita\metaphone\filters;

use insolita\metaphone\Filter;
use function preg_replace;

class HandleLastnameEndings implements Filter
{

    public function apply(string $string):string
    {
        $patterns = [
            '~овский$~' => '@',
            '~евский$~' => '#',
            '~овская$~' => '$',
            '~евская$~' => '%',
            '~(ук|юк)$~' => '0',
            '~ина$~' => '1',
            '~(ик|ек)$~' => '2',
            '~нко$~' => '3',
            '~(иев|еев|ов|ев|ёв)$~' => '4',
            '~(ых|их)$~' => '5',
            '~ая$~' => '6',
            '~(ий|ый)$~' => '7',
            '~(иева|еева|ова|ева|ёва)$~' => '8',
            '~ин$~' => '9',
        ];
        foreach ($patterns as $pattern => $replacement) {
            $string = (string)preg_replace($pattern . 'su', $replacement, $string);
        }
        return $string;
    }
}