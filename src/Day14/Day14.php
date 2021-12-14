<?php

declare(strict_types=1);

namespace Aoc2021\Day14;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day14 implements Runnable
{
	/**
	 * @return array{string, array<string, string>}
	 */
	private function parse(string $input): array
	{
		[$polymer, $instructions] = Parser::getElements($input, "\n\n");
		$instructions = Parser::getLines($instructions)->flatMap(static function ($l) {
			$p = \explode(' -> ', $l);

			return [$p[0] => $p[1]];
		});

		return [$polymer, $instructions];
	}

	/**
	 * Naive solution works fine for part 1
	 */
	public function part1(string $input): string
	{
		[$polymer, $instructions] = $this->parse($input);

		for ($s = 1; $s <= 10; $s += 1) {
			$pl = \strlen($polymer);
			$newPolymer = $polymer[0];

			for ($i = 1; $i < $pl; $i += 1) {
				$in = \substr($polymer, $i - 1, 2);
				if (isset($instructions[$in])) {
					$newPolymer .= $instructions[$in];
				}
				$newPolymer .= $polymer[$i];
			}

			$polymer = $newPolymer;
		}

		$map = [];
		$pl = \strlen($polymer);
		for ($i = 0; $i < $pl; $i += 1) {
			$c = $polymer[$i];
			$map[$c] = ($map[$c] ?? 0) + 1;
		}

		\asort($map);

		return (string)((int)\array_pop($map) - (int)\array_shift($map));
	}

	/**
	 * Has to use more sophisticated solution.
	 */
	public function part2(string $input): string
	{
		[$polymer, $instructions] = $this->parse($input);
		$pairs = [];

		$pl = \strlen($polymer);
		for ($i = 1; $i < $pl; $i += 1) {
			$n = \substr($polymer, $i - 1, 2);
			$pairs[$n] = ($pairs[$n] ?? 0) + 1;
		}

		for ($s = 1; $s <= 40; $s += 1) {
			$newPairs = [];
			foreach ($pairs as $pair => $n) {
				if (!isset($instructions[$pair])) {
					$newPairs[$pair] = ($newPairs[$pair] ?? 0) + $n;

					continue;
				}

				$p1 = $pair[0] . $instructions[$pair];
				$newPairs[$p1] = ($newPairs[$p1] ?? 0) + $n;
				$p2 = $instructions[$pair] . $pair[1];
				$newPairs[$p2] = ($newPairs[$p2] ?? 0) + $n;
			}

			$pairs = $newPairs;
		}

		$map = [$polymer[0] => 1];
		foreach ($pairs as $key => $n) {
			$c = $key[1];
			$map[$c] = ($map[$c] ?? 0) + $n;
		}

		\asort($map);

		return (string)((int)\array_pop($map) - (int)\array_shift($map));
	}
}
