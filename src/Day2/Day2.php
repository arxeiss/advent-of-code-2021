<?php

declare(strict_types=1);

namespace Aoc2021\Day2;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day2 implements Runnable
{
	public function part1(string $input): string
	{
		$items = Parser::getLineElements($input);

		$h = 0;
		$d = 0;

		foreach ($items as $instruction) {
			[$d, $h] = match ($instruction[0]) {
				'down' => [$d + (int)$instruction[1], $h],
				'up' => [$d + (int)(-$instruction[1]), $h],
				default => [$d, $h + (int)$instruction[1]],
			};
		}

		return (string)($h * $d);
	}

	public function part2(string $input): string
	{
		$items = Parser::getLineElements($input);

		$h = 0;
		$d = 0;
		$a = 0;

		foreach ($items as $instruction) {
			if ($instruction[0] === 'forward') {
				$h += (int)$instruction[1];
				$d += (int)$instruction[1] * $a;

				continue;
			}
			$a += match ($instruction[0]) {
				'down' => (int)$instruction[1],
				'up' => (int)(-$instruction[1]),
			};
		}

		return (string)($h * $d);
	}
}
