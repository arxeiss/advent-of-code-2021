<?php

declare(strict_types=1);

namespace Aoc2021\Day3;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day3 implements Runnable
{
	public function part1(string $input): string
	{
		$lines = Parser::getLines($input);

		$width = \strlen($lines->get(0));
		$ones = \array_fill(0, $width, 0);
		$zeros = \array_fill(0, $width, 0);

		foreach ($lines as $line) {
			for ($i = 0; $i < $width; $i += 1) {
				if ($line[$i] === '0') {
					$zeros[$i] += 1;
				} else {
					$ones[$i] += 1;
				}
			}
		}

		$gamma = '';
		$epsilon = '';

		for ($i = 0; $i < $width; $i += 1) {
			if ($zeros[$i] > $ones[$i]) {
				$gamma .= '0';
				$epsilon .= '1';
			} else {
				$gamma .= '1';
				$epsilon .= '0';
			}
		}

		return (string)(\bindec($gamma) * \bindec($epsilon));
	}

	public function part2(string $input): string
	{
		$lines = Parser::getLines($input);

		[$zeros, $ones] = $this->countOccurrences($lines, 0);

		if ($zeros > $ones) {
			$oxygen = $this->filterOut($lines->filter(static fn ($e) => $e[0] === '0'), 1, '1', true);
			$co2 = $this->filterOut($lines->filter(static fn ($e) => $e[0] === '1'), 1, '0', false);
		} else {
			$oxygen = $this->filterOut($lines->filter(static fn ($e) => $e[0] === '1'), 1, '1', true);
			$co2 = $this->filterOut($lines->filter(static fn ($e) => $e[0] === '0'), 1, '0', false);
		}

		return (string)(\bindec($oxygen) * \bindec($co2));
	}

	/**
	 * @return array<int>
	 */
	public function countOccurrences(Collection $lines, int $position): array
	{
		$zeros = $ones = 0;
		foreach ($lines as $line) {
			if ($line[$position] === '0') {
				$zeros += 1;
			} else {
				$ones += 1;
			}
		}

		return [$zeros, $ones];
	}

	public function filterOut(Collection $lines, int $position, string $initialBit, bool $mostOccurrences): string
	{
		if ($lines->count() === 1) {
			return $lines->first();
		}

		[$zeros, $ones] = $this->countOccurrences($lines, $position);

		$keepBit = $initialBit;

		if ($zeros > $ones) {
			$keepBit = $mostOccurrences ? '0' : '1';
		} elseif ($zeros < $ones) {
			$keepBit = $mostOccurrences ? '1' : '0';
		}

		return $this->filterOut(
			$lines->filter(static fn ($e) => $e[$position] === $keepBit),
			$position + 1,
			$initialBit,
			$mostOccurrences,
		);
	}
}
