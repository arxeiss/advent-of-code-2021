<?php

declare(strict_types=1);

namespace Aoc2021\Day13;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day13 implements Runnable
{
	/**
	 * @return array{array<int, array<int, string>>, array<array{string, int}>}
	 */
	private function parse(string $input): array
	{
		[$dots, $instructions] = Parser::getElements($input, "\n\n");
		$dots = Parser::getLineElements($dots, ',')->map(static function ($l) {
			$l[0] = (int)$l[0];
			$l[1] = (int)$l[1];

			return $l;
		});
		$instructions = Parser::getLines($instructions)->map(static function ($l) {
			$l = \str_replace('fold along ', '', $l);
			$p = \explode('=', \str_replace('fold along ', '', $l));

			return [$p[0], (int)$p[1]];
		});

		$map = [];
		foreach ($dots as [$x, $y]) {
			if (empty($map[$y])) {
				$map[$y] = [];
			}
			$map[$y][$x] = '#';
		}

		return [$map, $instructions];
	}

	public function part1(string $input): string
	{
		[$map, $instructions] = $this->parse($input);

		$map = $this->fold($map, $instructions[0][0] === 'x', $instructions[0][1]);

		$cnt = 0;
		foreach ($map as $row) {
			$cnt += \count($row);
		}

		return (string)$cnt;
	}

	public function part2(string $input): string
	{
		[$map, $instructions] = $this->parse($input);

		foreach ($instructions as [$dir, $coordinate]) {
			$map = $this->fold($map, $dir === 'x', $coordinate);
		}

		$res = "\n";
		$l = \count($map);
		for ($i = 0; $i < $l; $i += 1) {
			$s = \max(\array_keys($map[$i]));
			for ($r = 0; $r <= $s; $r += 1) {
				$res .= $map[$i][$r] ?? ' ';
			}
			$res .= "\n";
		}

		return $res;
	}

	/**
	 * @param  array<int, array<int, string>> $map
	 * @return array<int, array<int, string>>
	 */
	private function fold(array $map, bool $isX, int $coordinate): array
	{
		$newMap = [];

		foreach ($map as $y => $row) {
			//phpcs:ignore SlevomatCodingStandard.Variables.UnusedVariable.UnusedVariable
			foreach ($row as $x => $el) {
				$newX = $x;
				$newY = $y;

				if ($isX && $newX > $coordinate) {
					$newX = \abs($newX - 2 * $coordinate);
				} elseif (!$isX && $newY > $coordinate) {
					$newY = \abs($newY - 2 * $coordinate);
				}

				if (empty($newMap[$newY])) {
					$newMap[$newY] = [];
				}
				$newMap[$newY][$newX] = '#';
			}
		}

		return $newMap;
	}
}
