<?php

declare(strict_types=1);

namespace Aoc2021\Day10;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day10 implements Runnable
{
	/** @var array<string, int> */
	private array $corruptedScore = [')' => 3, ']' => 57, '}' => 1197, '>' => 25137];

	/** @var array<string, int> */
	private array $incompleteScore = [')' => 1, ']' => 2, '}' => 3, '>' => 4];

	/**
	 * @return array{int, int}
	 */
	private function solve(string $input): array
	{
		$lines = Parser::getLines($input);

		$corruptedScore = 0;
		$incompleteScores = new Collection();

		foreach ($lines as $line) {
			$toMatch = [];
			$isInvalid = false;

			$ll = \strlen($line);
			for ($i = 0; $i < $ll; $i += 1) {
				$found = $line[$i];

				$expect = match ($found) {
					'(' => \array_push($toMatch, ')'),
					'{' => \array_push($toMatch, '}'),
					'[' => \array_push($toMatch, ']'),
					'<' => \array_push($toMatch, '>'),
					default => \array_pop($toMatch),
				};
				// array_push returns numbers, so need to check if it is string
				if (\is_string($expect) && $expect !== $found) {
					$isInvalid = true;
					$corruptedScore += $this->corruptedScore[$found];

					break;
				}
			}

			if (!$isInvalid) {
				$score = 0;
				for ($i = \count($toMatch) - 1; $i >= 0; $i -= 1) {
					$score = $score * 5 + $this->incompleteScore[$toMatch[$i]];
				}
				$incompleteScores->add($score);
			}
		}

		return [$corruptedScore, $incompleteScores->median()];
	}

	public function part1(string $input): string
	{

		[$corruptedScore] = $this->solve($input);

		return (string)$corruptedScore;
	}

	public function part2(string $input): string
	{
		[, $incompleteScore] = $this->solve($input);

		return (string)$incompleteScore;
	}
}
