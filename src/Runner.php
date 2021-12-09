<?php

declare(strict_types=1);

namespace Aoc2021;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Day1\Day1;
use Aoc2021\Day2\Day2;
use Aoc2021\Day3\Day3;
use Aoc2021\Day4\Day4;
use Aoc2021\Day5\Day5;
use Aoc2021\Day6\Day6;
use Aoc2021\Day7\Day7;
use Aoc2021\Day8\Day8;
use Aoc2021\Day9\Day9;

class Runner
{
	/** @var array<int, Runnable> */
	private array $days = [
		1 => Day1::class,
		2 => Day2::class,
		3 => Day3::class,
		4 => Day4::class,
		5 => Day5::class,
		6 => Day6::class,
		7 => Day7::class,
		8 => Day8::class,
		9 => Day9::class,
	];

	public function start(string $argDay = '', string $argPart = ''): void
	{
		$day = (int)$argDay;
		if ($day === 0) {
			$from = \min(\array_keys($this->days));
			$to = \max(\array_keys($this->days));

			echo "Select a day to run [{$from}-{$to}]:\n";
			$day = (int)\trim((string)\readline('Day: '));
		}

		if (empty($this->days[$day])) {
			echo "This day does not exist\n";

			return;
		}

		$c = new $this->days[$day]();

		if (!$c instanceof Runnable) {
			echo "This day does not implements required contracts\n";

			return;
		}

		$part = (int)$argPart;
		if ($part === 0) {
			echo "Select part to run [1 or 2]:\n";
			$part = \trim((string)\readline('Part: ')) === '2' ? 2 : 1;
		}

		$inputFile = "src/Day{$day}/input.txt";
		if (!\file_exists($inputFile)) {
			echo "Input file '{$inputFile}' does not exists\n";

			return;
		}

		echo "\nResult of Day {$day} part {$part} is:\n\n  ";
		$start = \microtime(true);
		echo $c->{'part' . $part}(\file_get_contents($inputFile));
		echo "\n\nFinished in " . \round((\microtime(true) - $start) * 1000, 5) . " ms\nGood bye\n";
	}
}
