<?php

namespace insolita\metaphone\filters;

use insolita\metaphone\Filter;
use voku\helper\UTF8;
use function array_key_exists;
use function count;
use function implode;
use function in_array;

class HandleConsonants implements Filter
{
    private const RESONANT = ['л', 'м', 'н', 'р'];
    private const REPLACEMENTS = ['б' => 'п', 'в' => 'ф', 'г' => 'к', 'д' => 'т', 'ж' => 'ш', 'з' => 'с'];

    /**
     * @var bool
     */
    private $skipBeforeResonant;

    public function __construct(bool $skipBeforeResonant = false)
    {
        $this->skipBeforeResonant = $skipBeforeResonant;
    }

    public function apply(string $string):string
    {
        $previous = null;
        $chars = UTF8::str_split($string);
        foreach ($chars as $index => $char) {

            $isPreviousVoiced = array_key_exists($previous, self::REPLACEMENTS);
            $isCurrentVoiceless = in_array($char, self::REPLACEMENTS, true);
            $isCurrentResonant = in_array($char, self::RESONANT, true);

            if ($isPreviousVoiced && ($isCurrentVoiceless || ($isCurrentResonant && !$this->skipBeforeResonant))) {
                $chars[$index - 1] = self::REPLACEMENTS[$previous];
            }

            $previous = $char;
        }
        if (array_key_exists($previous, self::REPLACEMENTS)) {
            $chars[count($chars) - 1] = self::REPLACEMENTS[$previous];
        }

        return implode('', $chars);
    }
}