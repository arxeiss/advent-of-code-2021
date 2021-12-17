<?php

declare(strict_types=1);

namespace Aoc2021\Day17;

use Aoc2021\Contracts\Runnable;

class Day17 implements Runnable
{
	/**
	 * @return array{int, int, int, int}
	 */
	private function parse(string $input): array
	{
		$matches = [];
		\preg_match('/x=(-?[0-9]+)..(-?[0-9]+), y=(-?[0-9]+)..(-?[0-9]+)/', $input, $matches);

		$xMin = \min((int)$matches[1], (int)$matches[2]);
		$xMax = \max((int)$matches[1], (int)$matches[2]);

		$yMin = \min((int)$matches[3], (int)$matches[4]);
		$yMax = \max((int)$matches[3], (int)$matches[4]);

		return [$xMin, $xMax, $yMin, $yMax];
	}

	public function part1(string $input): string
	{
		[, , $yMin] = $this->parse($input);
		$yMin = \abs($yMin) - 1;

		return (string)(($yMin + 1) * $yMin / 2);
	}

	public function part2(string $input): string
	{
		[$xMin, $xMax, $yMin, $yMax] = $this->parse($input);
		$possibleVelocities = [];
		for ($xVel = (int)\ceil(\sqrt($xMin)); $xVel <= $xMax; $xVel += 1) {
			for ($slowTo = $xVel; $slowTo >= 0; $slowTo -= 1) {
				$r = \range($slowTo, $xVel);
				$xDrop = \array_sum($r);
				$steps = \count($r);

				if ($xDrop >= $xMin && $xDrop <= $xMax) {
					if ($slowTo === 0) {
						for ($i = $yMin; $i < $yMin * -1; $i += 1) {
							$finalY = 0;
							for ($s = 0; $finalY >= $yMin; $s += 1) {
								$finalY += $i - $s;

								if ($s >= $steps - 1 && $finalY <= $yMax && $finalY >= $yMin) {
									$possibleVelocities["{$xVel}:{$i}"] = true;
								}
							}
						}

						continue;
					}

					for ($i = $yMin; $i < $yMin * -1; $i += 1) {
						$finalY = 0;
						for ($s = 0; $s < $steps; $s += 1) {
							$finalY += $i - $s;
						}

						if ($finalY <= $yMax && $finalY >= $yMin) {
							$possibleVelocities["{$xVel}:{$i}"] = true;
						}
					}
				}
			}
		}

		return (string)\count($possibleVelocities);
	}
}
