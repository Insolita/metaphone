<?php

namespace insolita\metaphone;

interface Filter
{
    public function apply(string $string):string;
}