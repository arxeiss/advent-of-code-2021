<?php

declare(strict_types=1);

namespace Aoc2021\Day20;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day20 implements Runnable
{
	public function part1(string $input): string
	{
		return $this->solve($input, 2);
	}

	public function part2(string $input): string
	{
		return $this->solve($input, 50);
	}

	public function solve(string $input, int $iterations): string
	{
		$minX = $minY = 0;
		[$code, $map, $maxX, $maxY] = $this->parseInput($input);
		$doFlip = $code[0] === '#';

		for ($i = 0; $i < $iterations; $i += 1) {
			$newMinY = $newMinX = \PHP_INT_MAX;
			$newMaxY = $newMaxX = \PHP_INT_MIN;

			$newMap = [];
			for ($x = $minX - 1; $x <= $maxX + 1; $x += 1) {
				for ($y = $minY - 1; $y <= $maxY + 1; $y += 1) {
					$b = '';
					for ($yo = -1; $yo <= 1; $yo += 1) {
						for ($xo = -1; $xo <= 1; $xo += 1) {
							$tx = $x + $xo;
							$ty = $y + $yo;
							if ($doFlip && ($tx < $minX || $tx > $maxX || $ty < $minY || $ty > $maxY)) {
								$b .= $i % 2 === 1 ? '1' : '0';
							} else {
								$b .= isset($map["{$tx}:{$ty}"]) ? '1' : '0';
							}
						}
					}
					if ($code[\bindec($b)] === '#') {
						$newMap["{$x}:{$y}"] = true;
						$newMinX = \min($newMinX, $x);
						$newMaxX = \max($newMaxX, $x);
						$newMinY = \min($newMinY, $y);
						$newMaxY = \max($newMaxY, $y);
					}
				}
			}
			$map = $newMap;
			$minX = $newMinX;
			$maxX = $newMaxX;
			$minY = $newMinY;
			$maxY = $newMaxY;
		}

		return (string)\count($map);
	}

	/**
	 * @return array{string, array<string, bool>, int, int}
	 */
	public function parseInput(string $input): array
	{
		$inputParts = Parser::getElements($input, "\n\n");
		$code = $inputParts[0];
		$map = [];

		$lines = Parser::getLines($inputParts[1]);
		$maxY = $lines->count() - 1;
		$maxX = \strlen($lines[0]) - 1;
		foreach ($lines as $y => $line) {
			for ($x = 0; $x <= $maxX; $x += 1) {
				if ($line[$x] === '#') {
					$map["{$x}:{$y}"] = true;
				}
			}
		}

		return [$code, $map, $maxX, $maxY];
	}
}
