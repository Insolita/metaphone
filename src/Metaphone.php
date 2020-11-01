<?php

namespace insolita\metaphone;

use insolita\metaphone\filters\HandleConsonants;
use insolita\metaphone\filters\HandleLastnameEndings;
use insolita\metaphone\filters\Normalize;
use insolita\metaphone\filters\RemoveDoubleChars;
use insolita\metaphone\filters\Replacements;
use function is_string;

/**
 * @see http://forum.aeroion.ru/topic461.html
 * @see https://github.com/pavlo/russian_metaphone
 **/
final class Metaphone
{
    private static $defaultFilters = [
        Normalize::class,
        RemoveDoubleChars::class,
        HandleLastnameEndings::class,
        Replacements::class,
        HandleConsonants::class,
        RemoveDoubleChars::class,
    ];

    /**
     * @var array|string[]|\insolita\metaphone\Filter[]
     */
    private $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters ?: static::$defaultFilters;
    }

    public function skipLastnames():Metaphone
    {
        return new self([
            Normalize::class,
            RemoveDoubleChars::class,
            Replacements::class,
            HandleConsonants::class,
            RemoveDoubleChars::class,
        ]);
    }

    public function processWord(string $word):string
    {
        foreach ($this->filters as $filter) {
            $filter = is_string($filter) ? new $filter : $filter;
            $word = $filter->apply($word);
        }
        return $word;
    }

}