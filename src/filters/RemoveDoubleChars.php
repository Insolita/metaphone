<?php

namespace insolita\metaphone\filters;

use insolita\metaphone\Filter;
use voku\helper\UTF8;
use function array_filter;
use function implode;

class RemoveDoubleChars implements Filter
{

    public function apply(string $string):string
    {
        $previous = null;
        $chars = UTF8::str_split($string);
        foreach ($chars as $i => $char) {
            if ($char === $previous) {
                $chars[$i] = null;
            }
            $previous = $char;
        }
        return implode('', array_filter($chars));
    }
}