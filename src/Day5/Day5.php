<?php

declare(strict_types=1);

namespace Aoc2021\Day5;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day5 implements Runnable
{
	public function part1(string $input): string
	{
		$elements = $this->getElements($input);

		$matrix = new Collection();
		foreach ($elements as $line) {
			if ($line['x1'] !== $line['x2'] && $line['y1'] !== $line['y2']) {
				continue;
			}

			foreach (\range((int)$line['x1'], (int)$line['x2']) as $x) {
				foreach (\range((int)$line['y1'], (int)$line['y2']) as $y) {
					$c = "{$x}:{$y}";
					if ($matrix->offsetExists($c)) {
						$matrix[$c] += 1;

						continue;
					}
					$matrix[$c] = 1;
				}
			}
		}

		return (string)$matrix->filter(static fn ($e) => $e >= 2)->count();
	}

	public function part2(string $input): string
	{
		$elements = $this->getElements($input);

		$matrix = new Collection();
		foreach ($elements as $line) {
			if ($line['x1'] !== $line['x2'] && $line['y1'] !== $line['y2']) {
				// array_map with null callback is like `zip` function
				$points = \array_map(
					null,
					\range((int)$line['x1'], (int)$line['x2']),
					\range((int)$line['y1'], (int)$line['y2']),
				);
				foreach ($points as [$x, $y]) {
					$c = "{$x}:{$y}";
					if ($matrix->offsetExists($c)) {
						$matrix[$c] += 1;
					} else {
						$matrix[$c] = 1;
					}
				}

				continue;
			}

			foreach (\range((int)$line['x1'], (int)$line['x2']) as $x) {
				foreach (\range((int)$line['y1'], (int)$line['y2']) as $y) {
					$c = "{$x}:{$y}";
					if ($matrix->offsetExists($c)) {
						$matrix[$c] += 1;
					} else {
						$matrix[$c] = 1;
					}
				}
			}
		}

		return (string)$matrix->filter(static fn ($e) => $e >= 2)->count();
	}

	private function getElements(string $input): Collection
	{
		return Parser::getLines($input)->map(static function ($e) {
			$matches = [];
			\preg_match('/(?<x1>[0-9]+),(?<y1>[0-9]+) -> (?<x2>[0-9]+),(?<y2>[0-9]+)/', $e, $matches);

			return $matches;
		});
	}
}
