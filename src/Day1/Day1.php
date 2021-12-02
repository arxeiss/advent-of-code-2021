<?php

namespace Aoc2021\Day1;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day1 implements Runnable
{
	public function part1(string $input): string
	{
		$items = Parser::getIntLines($input);

		return $this->countIncreases($items);
	}

	public function countIncreases(Collection $items): string
	{
		$cnt = $items->reduce(function ($carry, $item) {
			$carry[1] += $carry[0] < $item ? 1 : 0;
			$carry[0] = $item;

			return $carry;
		}, [PHP_INT_MAX, 0]);

		return (string)$cnt[1];
	}

	public function part2(string $input): string
	{
		$lines = Parser::getIntLines($input);

		$groupItems = new Collection();

		$groupItems[0] = $lines[0] + $lines[1];
		$groupItems[1] = $lines[1];

		$upTo = $lines->count() - 2;
		for ($i = 2; $i < $upTo; $i++) {
			$groupItems[$i - 2] += $lines[$i];
			$groupItems[$i - 1] += $lines[$i];
			$groupItems[$i] = $lines[$i];
		}

		$groupItems[$upTo - 2] += $lines[$upTo - 2];
		$groupItems[$upTo - 1] += $lines[$upTo - 1] + $lines[$upTo - 2];

		return $this->countIncreases($groupItems);
	}
}
