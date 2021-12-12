<?php

declare(strict_types=1);

namespace Aoc2021\Day12;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Day12 implements Runnable
{
	/** @var array<string, array<string>> */
	private array $map = [];

	public function part1(string $input): string
	{
		$this->toMap($input);

		$pathsToEnd = 0;
		foreach ($this->map['start'] as $to) {
			// For part 1 just pass 'true' as something was visited twice
			$pathsToEnd += $this->countPaths(['start'], $to, true);
		}

		return (string)$pathsToEnd;
	}

	public function part2(string $input): string
	{
		$this->toMap($input);

		$pathsToEnd = 0;
		foreach ($this->map['start'] as $to) {
			$pathsToEnd += $this->countPaths(['start'], $to, false);
		}

		return (string)$pathsToEnd;
	}

	private function toMap(string $input): void
	{
		$paths = Parser::getLineElements($input, '-');
		$map = [];
		foreach ($paths as [$from, $to]) {
			if (!isset($map[$from])) {
				$map[$from] = [];
			}
			if (!isset($map[$to])) {
				$map[$to] = [];
			}

			// Make sure there is no path back to the start
			if ($to !== 'start') {
				$map[$from][] = $to;
			}
			if ($from !== 'start') {
				$map[$to][] = $from;
			}
		}

		$this->map = $map;
	}

	/**
	 * @param array<string> $path
	 */
	private function countPaths(array $path, string $dest, bool $someVisitedTwice): int
	{
		if ($dest === 'end') {
			return 1;
		}

		if ($dest === \strtolower($dest) && \in_array($dest, $path)) {
			if ($someVisitedTwice) {
				return 0;
			}
			$someVisitedTwice = true;
		}

		$path[] = $dest;
		$pathsToEnd = 0;

		foreach ($this->map[$dest] as $to) {
			$pathsToEnd += $this->countPaths($path, $to, $someVisitedTwice);
		}

		return $pathsToEnd;
	}
}
