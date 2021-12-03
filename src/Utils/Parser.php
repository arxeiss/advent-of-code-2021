<?php

declare(strict_types=1);

namespace Aoc2021\Utils;

use Aoc2021\Utils\Collection;

class Parser
{
	public static function getLines(string $input): Collection
	{
		return (new Collection(\explode("\n", $input)))->filter();
	}

	public static function getLineElements(string $input, string $delimiter = ' '): Collection
	{
		return static::getLines($input)->map(static fn ($e) => \explode($delimiter, $e));
	}

	public static function getIntLines(string $input): Collection
	{
		return static::getLines($input)->map(static fn ($i) => (int)$i);
	}
}
