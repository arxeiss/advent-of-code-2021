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
		$elements = Parser::getLines($input)->map(static function ($e) {
			$matches = [];
			\preg_match('/(?<x1>[0-9]+),(?<y1>[0-9]+) -> (?<x2>[0-9]+),(?<y2>[0-9]+)/', $e, $matches);

			return [
				'x1' => \min((int)$matches['x1'], (int)$matches['x2']),
				'x2' => \max((int)$matches['x1'], (int)$matches['x2']),
				'y1' => \min((int)$matches['y1'], (int)$matches['y2']),
				'y2' => \max((int)$matches['y1'], (int)$matches['y2']),
			];
		});

		$matrix = new Collection();
		foreach ($elements as $line) {
			if ($line['x1'] !== $line['x2'] && $line['y1'] !== $line['y2']) {
				continue;
			}

			for ($x = $line['x1']; $x <= $line['x2']; $x += 1) {
				for ($y = $line['y1']; $y <= $line['y2']; $y += 1) {
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
		$elements = Parser::getLines($input)->map(static function ($e) {
			$matches = [];
			\preg_match('/(?<x1>[0-9]+),(?<y1>[0-9]+) -> (?<x2>[0-9]+),(?<y2>[0-9]+)/', $e, $matches);

			return [
				'x1' => (int)$matches['x1'],
				'x2' => (int)$matches['x2'],
				'y1' => (int)$matches['y1'],
				'y2' => (int)$matches['y2'],
			];
		});

		$matrix = new Collection();
		foreach ($elements as $line) {
			if ($line['x1'] !== $line['x2'] && $line['y1'] !== $line['y2']) {
				$elLength = \abs($line['x1'] - $line['x2']);
				$addToX = $line['x1'] < $line['x2'] ? 1 : -1;
				$addToY = $line['y1'] < $line['y2'] ? 1 : -1;

				$i = 0;
				$x = $line['x1'];
				$y = $line['y1'];
				for (; $i <= $elLength; $x += $addToX, $y += $addToY, $i += 1) {
					$c = "{$x}:{$y}";
					if ($matrix->offsetExists($c)) {
						$matrix[$c] += 1;
					} else {
						$matrix[$c] = 1;
					}
				}

				continue;
			}

			$normLine = [
				'x1' => \min($line['x1'], $line['x2']),
				'x2' => \max($line['x1'], $line['x2']),
				'y1' => \min($line['y1'], $line['y2']),
				'y2' => \max($line['y1'], $line['y2']),
			];

			for ($x = $normLine['x1']; $x <= $normLine['x2']; $x += 1) {
				for ($y = $normLine['y1']; $y <= $normLine['y2']; $y += 1) {
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
}
