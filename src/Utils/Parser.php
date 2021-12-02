<?php

namespace Aoc2021\Utils;

use Aoc2021\Utils\Collection;

class Parser
{
	static public function getLines(string $input): Collection
	{
		return (new Collection(explode("\n", $input)))->filter();
	}

	static public function getIntLines(string $input): Collection
	{
		return static::getLines($input)->map(fn ($i) => (int)$i);
	}
}
