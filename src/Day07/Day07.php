<?php

declare(strict_types=1);

namespace Aoc2021\Day07;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day07 implements Runnable
{
	public function part1(string $input): string
	{
		$dist = Parser::getIntElements($input, ',')->sort()->values();

		$middle = $dist->count() / 2;
		$median = ($dist[$middle - 1] + $dist[$middle]) / 2;

		$distSum = 0;
		foreach ($dist as $d) {
			$distSum += \abs($median - $d);
		}

		return (string)$distSum;
	}

	public function part2(string $input): string
	{
		$dist = Parser::getIntElements($input, ',')->sort()->values();

		$avg = \floor($dist->sum() / $dist->count());

		// Check some numbers around average as there is rounding issue
		$minDists = [];
		for ($i = $avg; $i <= $avg + 1; $i += 1) {
			$distSum = 0;
			foreach ($dist as $d) {
				$totalDist = \abs($i - $d);
				if ($totalDist === 0) {
					continue;
				}
				$distSum += \array_sum(\range(1, $totalDist));
			}
			$minDists[] = $distSum;
		}

		return (string)\min($minDists);
	}
}
