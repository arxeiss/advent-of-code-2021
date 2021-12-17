<?php

declare(strict_types=1);

namespace Aoc2021\Day17;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day17 implements Runnable
{
	public function part1(string $input): string
	{
		$matches = [];
		preg_match('/x=(-?[0-9]+)..(-?[0-9]+), y=(-?[0-9]+)..(-?[0-9]+)/', $input, $matches);

		$yMin = abs((int)$matches[3]) - 1;
		return (string)(($yMin + 1) * $yMin / 2);
	}

	public function part2(string $input): string
	{
		$matches = [];
		preg_match('/x=(-?[0-9]+)..(-?[0-9]+), y=(-?[0-9]+)..(-?[0-9]+)/', $input, $matches);

		$xMin = min((int)$matches[1], (int)$matches[2]);
		$xMax = max((int)$matches[1], (int)$matches[2]);

		$yMin = min((int)$matches[3], (int)$matches[4]);
		$yMax = max((int)$matches[3], (int)$matches[4]);

		var_dump([
			'xMin' => $xMin,
			'xMax' => $xMax,
			'yMin' => $yMin,
			'yMax' => $yMax,
		]);

		$possibleXVelocity = [];
		$possibleVelocities = 0;
		for ($xVel = 4; $xVel < $xMax; $xVel += 1) {
			for ($slowTo = $xVel; $slowTo >= 0; $slowTo -= 1) {
				$r = range($slowTo, $xVel);
				$xDrop = array_sum($r);
				$steps = count($r);

				if ($xDrop >= $xMin && $xDrop <= $xMax) {
					$possibleXVelocity[] = [$steps, $xVel];

					// if ($slowTo === 0) {
					// 	$possibleVelocities += abs($yMin) - 1;
					// } else {
					// 	for ($i = $yMin; $i < $yMin * -1; $i++) {
					// 		$ry = range($i, $i - $steps);
					// 		if (count($ry) !== $steps) {
					// 			continue;
					// 		}
					// 		$yDrop = array_sum($ry);
					// 		if ($yDrop) {
					// 			// code...
					// 		}
					// 	}
					// }

					// break;
				}
			}
		}

		print_r($possibleXVelocity);

		// $possibleYVelocity = [];
		// for ($i = 1; true; $i += 1) {
		// 	// for ($d = $i; $d >= 0; $d -= 1) {
		// 	$yDrop = array_sum(range($d, $i));
		// 	if ($yDrop >= $yMin && $yDrop <= $yMax && !in_array($i, $possibleYVelocity)) {
		// 		$possibleYVelocity[] = $i;
		// 	}
		// 	// if ($i > $xMax) {
		// 	// 	break 2;
		// 	// }
		// 	// }
		// }

		// var_dump($possibleYVelocity);

		return "";
	}
}
