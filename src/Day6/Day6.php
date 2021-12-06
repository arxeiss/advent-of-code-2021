<?php

declare(strict_types=1);

namespace Aoc2021\Day6;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day6 implements Runnable
{
	public function part1(string $input): string
	{
		return $this->solve($input, 80);
	}

	public function part2(string $input): string
	{
		return $this->solve($input, 256);
	}

	private function solve(string $input, int $days): string
	{
		$rawInput = Parser::getIntElements($input, ',');

		$fishes = \array_fill(0, 9, 0);

		foreach ($rawInput as $fishAge) {
			$fishes[$fishAge] += 1;
		}

		for ($day = 0; $day < $days; $day += 1) {
			$fishes = [
				0 => $fishes[1],
				1 => $fishes[2],
				2 => $fishes[3],
				3 => $fishes[4],
				4 => $fishes[5],
				5 => $fishes[6],
				6 => $fishes[7] + $fishes[0],
				7 => $fishes[8],
				8 => $fishes[0],
			];
		}

		return (string)\array_sum($fishes);
	}
}
