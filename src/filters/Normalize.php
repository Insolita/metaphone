<?php

namespace insolita\metaphone\filters;

use insolita\metaphone\Filter;
use voku\helper\UTF8;
use function preg_replace;

class Normalize implements Filter
{

    public function apply(string $string):string
    {
        $string = (string)preg_replace('~\P{Cyrillic}+~u', '', UTF8::strtolower($string));
        return (string)preg_replace('~[ъь]~u', '', $string);
    }
}