<?php

declare(strict_types=1);

namespace Aoc2021\Day21;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Day21\GameState;
use Aoc2021\Utils\Parser;

class Day21 implements Runnable
{
	public function part1(string $input): string
	{
		[$p1p, $p2p] = Parser::getLines($input)->map(static fn ($l) => (int)\trim(\explode(':', $l)[1]));
		$p1p -= 1;
		$p2p -= 1;

		$p1s = $p2s = 0;
		$d = 2;

		while (true) {
			$p1p = ($p1p + $d * 3) % 10;
			$p1s += $p1p + 1;
			$d += 3;

			if ($p1s >= 1000) {
				break;
			}

			$p2p = ($p2p + $d * 3) % 10;
			$p2s += $p2p + 1;
			$d += 3;

			if ($p2s >= 1000) {
				break;
			}
		}

		return (string)(\min($p1s, $p2s) * ($d - 2));
	}

	/**
	 * phpcs:disable SlevomatCodingStandard.Functions.FunctionLength
	 */
	public function part2(string $input): string
	{
		[$p1p, $p2p] = Parser::getLines($input)->map(static fn ($l) => (int)\trim(\explode(':', $l)[1]));
		$s = new GameState($p1p - 1, 0, $p2p - 1, 0);

		$rolls = [
			3 => 1,
			4 => 3,
			5 => 6,
			6 => 7,
			7 => 6,
			8 => 3,
			9 => 1,
		];

		/** @var array<string, GameState> $states */
		$states = [$s->ID() => $s];
		/** @var array<string, int> $cache */
		$cache = [$s->ID() => 1];
		$finals = [1 => 0, 0];

		while (\count($cache) > 0) {
			// Iterate over for 2 players
			for ($i = 1; $i <= 2; $i += 1) {
				$toRemove = [];
				$toAdd = [];

				foreach ($cache as $stateKey => $size) {
					$toRemove[] = $stateKey;
					$s = $states[$stateKey];

					foreach ($rolls as $diceSum => $rollSize) {
						if ($i === 1) {
							$newPos = ($s->p1Pos + $diceSum) % 10;
							$rs = new GameState($newPos, $s->p1Score + $newPos + 1, $s->p2Pos, $s->p2Score);
							if ($rs->p1Score >= 21) {
								$finals[1] += $size * $rollSize;

								continue;
							}
						} else {
							$newPos = ($s->p2Pos + $diceSum) % 10;
							$rs = new GameState($s->p1Pos, $s->p1Score, $newPos, $s->p2Score + $newPos + 1);
							if ($rs->p2Score >= 21) {
								$finals[2] += $size * $rollSize;

								continue;
							}
						}

						if (!isset($states[$rs->ID()])) {
							$states[$rs->ID()] = $rs;
						}
						$toAdd[$rs->ID()] = ($toAdd[$rs->ID()] ?? 0) + $size * $rollSize;
					}
				}

				foreach ($toRemove as $stateKey) {
					unset($cache[$stateKey]);
				}
				foreach ($toAdd as $stateKey => $size) {
					$cache[$stateKey] = ($cache[$stateKey] ?? 0) + $size;
				}
			}
		}

		return (string)\max($finals);
	}
}
