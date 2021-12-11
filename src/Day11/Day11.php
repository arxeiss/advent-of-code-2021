<?php

declare(strict_types=1);

namespace Aoc2021\Day11;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day11 implements Runnable
{
	/**
	 * phpcs:disable SlevomatCodingStandard.Functions.FunctionLength
	 *
	 * @param array<array<int>> &$octopus
	 */
	private function iteration(array &$octopus): int
	{
		$flashes = 0;

		for ($y = 0; $y < 10; $y += 1) {
			for ($x = 0; $x < 10; $x += 1) {
				$octopus[$y][$x] += 1;
			}
		}

		$hasChanges = true;
		while ($hasChanges) {
			$hasChanges = false;

			for ($y = 0; $y < 10; $y += 1) {
				for ($x = 0; $x < 10; $x += 1) {
					if (!\is_integer($octopus[$y][$x]) || $octopus[$y][$x] <= 9) {
						continue;
					}

					$octopus[$y][$x] = true;
					$flashes += 1;
					$hasChanges = true;

					if (\is_integer($octopus[$y - 1][$x - 1] ?? null)) {
						$octopus[$y - 1][$x - 1] += 1;
					}
					if (\is_integer($octopus[$y - 1][$x] ?? null)) {
						$octopus[$y - 1][$x] += 1;
					}
					if (\is_integer($octopus[$y - 1][$x + 1] ?? null)) {
						$octopus[$y - 1][$x + 1] += 1;
					}
					if (\is_integer($octopus[$y][$x - 1] ?? null)) {
						$octopus[$y][$x - 1] += 1;
					}
					if (\is_integer($octopus[$y][$x + 1] ?? null)) {
						$octopus[$y][$x + 1] += 1;
					}
					if (\is_integer($octopus[$y + 1][$x - 1] ?? null)) {
						$octopus[$y + 1][$x - 1] += 1;
					}
					if (\is_integer($octopus[$y + 1][$x] ?? null)) {
						$octopus[$y + 1][$x] += 1;
					}
					if (\is_integer($octopus[$y + 1][$x + 1] ?? null)) {
						$octopus[$y + 1][$x + 1] += 1;
					}
				}
			}
		}

		for ($y = 0; $y < 10; $y += 1) {
			for ($x = 0; $x < 10; $x += 1) {
				if ($octopus[$y][$x] === true) {
					$octopus[$y][$x] = 0;
				}
			}
		}

		return $flashes;
	}

	public function part1(string $input): string
	{
		$octopus = Parser::getLines($input)->map(static function ($l) {
			$l = \str_split($l);

			return \array_map(static fn ($e) => (int)$e, $l);
		})->toArray();

		$flashes = 0;
		for ($s = 0; $s < 100; $s += 1) {
			$flashes += $this->iteration($octopus);
		}

		return (string)$flashes;
	}

	public function part2(string $input): string
	{
		$octopus = Parser::getLines($input)->map(static function ($l) {
			$l = \str_split($l);

			return \array_map(static fn ($e) => (int)$e, $l);
		})->toArray();

		for ($s = 1; true; $s += 1) {
			if ($this->iteration($octopus) === 100) {
				break;
			}
		}

		return (string)$s;
	}
}
