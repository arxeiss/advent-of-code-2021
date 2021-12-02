<?php

declare(strict_types=1);

namespace Aoc2021\Contracts;

interface Runnable
{
	public function part1(string $input): string;

	public function part2(string $input): string;
}
