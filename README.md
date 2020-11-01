# Russian metaphone phonetic algorithm implementation for PHP

![metaphone](https://github.com/Insolita/metaphone/workflows/metaphone/badge.svg)
port of ruby's https://github.com/pavlo/russian_metaphone

https://en.wikipedia.org/wiki/Metaphone

see http://forum.aeroion.ru/topic461.html (Russian algorithm description)

### Installation

`composer require insolita/metaphone`

### Usage

```
<?php

$word = 'вода';
$phonetic = (new Metaphone())->processWord($word); //вада
```

Default set of filters include filter for lastname endings, if you want exclude only these filter, you can use helper

```
$withLastnames = (new Metaphone())->processWord('Чернышевский'); //чирнаш#
$withoutLastnames = (new Metaphone())->skipLastnames()->processWord('Чернышевский'); //чирнашифский
```

Provide custom filters. Each filter must implement insolita\metaphone\Filter

```
$metaphone = new Metaphone([Normalize::class, new CustomFilter($params), new HandleConsonants(true), ...])
$phonetic = $metaphone->processWord($word);
```

See tests folder for better understanding filters