<?php

declare(strict_types=1);

namespace Aoc2021\Day9;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day9 implements Runnable
{
	public function part1(string $input): string
	{
		$codes = Parser::getLines($input)->map(static function ($l) {
			$nums = (new Collection(\str_split($l, 1)))->map(static fn ($e) => (int)$e);

			return $nums;
		});

		[$mins] = $this->getLows($codes);

		return (string)\array_sum($mins);
	}

	public function part2(string $input): string
	{
		$codes = Parser::getLines($input)->map(static function ($l) {
			$nums = (new Collection(\str_split($l, 1)))->map(static fn ($e) => (int)$e);

			return $nums;
		});

		[, $minsLoc] = $this->getLows($codes);
		$sizes = new Collection();

		foreach ($minsLoc as [$x, $y]) {
			$sizes->add($this->countBasinSize($codes, $x, $y));
		}

		return (string)$sizes
			->sort(static fn ($a, $b) => $b <=> $a)
			->slice(0, 3)
			->reduce(static fn ($a, $n) => $a * $n, 1);
	}

	/**
	 * @return array{array<int>, array{int, int}}
	 */
	private function getLows(Collection $codes): array
	{
		$height = $codes->count();
		$width = $codes[0]->count();
		$mins = [];
		$minsLoc = [];

		for ($y = 0; $y < $height; $y += 1) {
			for ($x = 0; $x < $width; $x += 1) {
				$adjacent = [
					$codes[$y - 1][$x] ?? 99,
					$codes[$y][$x - 1] ?? 99,
					$codes[$y + 1][$x] ?? 99,
					$codes[$y][$x + 1] ?? 99,
				];

				if ($codes[$y][$x] < \min($adjacent)) {
					$mins[] = $codes[$y][$x] + 1;
					$minsLoc[] = [$x, $y];
				}
			}
		}

		return [$mins, $minsLoc];
	}

	private function countBasinSize(Collection $map, int $x, int $y): int
	{
		if (($map[$y][$x] ?? 99) > 8) {
			return 0;
		}
		$map[$y][$x] = 99; // Reset currently counted to invalid to avoid infinite cycle

		$s = 1;
		$s += $this->countBasinSize($map, $x, $y - 1);
		$s += $this->countBasinSize($map, $x - 1, $y);
		$s += $this->countBasinSize($map, $x, $y + 1);
		$s += $this->countBasinSize($map, $x + 1, $y);

		return $s;
	}
}
