<?php

declare(strict_types=1);

namespace Aoc2021\Utils;

use Aoc2021\Utils\Collection;

class Parser
{
	public static function getLines(string $input): Collection
	{
		return static::getElements($input, "\n");
	}

	public static function getElements(string $input, string $separator): Collection
	{
		return (new Collection(\explode($separator, $input)))->filter(static fn ($e) => \strlen($e) > 0)->values();
	}

	public static function getLineElements(string $input, string $delimiter = ' '): Collection
	{
		return static::getLines($input)->map(static fn ($e) => static::getElements($e, $delimiter));
	}

	public static function getIntLines(string $input): Collection
	{
		return static::getLines($input)->map(static fn ($i) => (int)$i);
	}
}
