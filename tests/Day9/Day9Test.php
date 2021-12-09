<?php

declare(strict_types=1);

namespace Tests\Day9;

use Aoc2021\Day9\Day9;
use Tests\TestCase;

final class Day9Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day9())->part1($this->getTestInput());
		$this->assertSame($result, '15');
	}

	public function testPart2(): void
	{
		$result = (new Day9())->part2($this->getTestInput());
		$this->assertSame($result, '1134');
	}
}
