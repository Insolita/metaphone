<?php

namespace insolita\metaphone\filters;

use insolita\metaphone\Filter;

class Replacements implements Filter
{

    public function apply(string $string):string
    {
        $patterns = [
            '~тс|дс~' => 'ц',
            '~[їі]~' => 'и',
            '~[є]~' => 'е',
            '~йо|ио|йе|ие~' => 'и',
            '~[оыя]~' => 'а',
            '~[ю]~' => 'у',
            '~[еёэ]~' => 'и',
        ];
        foreach ($patterns as $pattern => $replacement) {
            $string = (string)preg_replace($pattern . 'su', $replacement, $string);
        }
        return $string;
    }
}