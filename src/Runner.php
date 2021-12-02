<?php

declare(strict_types=1);

namespace Aoc2021;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Day1\Day1;

class Runner
{
	/** @var array<int, Runnable> */
	private array $days = [
		1 => Day1::class,
	];

	public function start(): void
	{
		$from = \min(\array_keys($this->days));
		$to = \max(\array_keys($this->days));

		echo "Select a day to run [{$from}-{$to}]:\n";
		$day = (int)\trim((string)\readline('Day: '));

		if (empty($this->days[$day])) {
			echo "This day does not exist\n";

			return;
		}

		$c = new $this->days[$day]();

		if (!$c instanceof Runnable) {
			echo "This day does not implements required contracts\n";

			return;
		}

		echo "Selector part to run [1 or 2]:\n";
		$part = \trim((string)\readline('Part: ')) === '2' ? 2 : 1;

		$inputFile = "src/Day{$day}/input.txt";
		if (!\file_exists($inputFile)) {
			echo "Input file '{$inputFile}' does not exists\n";

			return;
		}

		echo "\nResult of Day {$day} part {$part} is:\n  ";
		echo $c->{'part' . $part}(\file_get_contents($inputFile));
		echo "\nGood bye\n";
	}
}
