<?php

declare(strict_types=1);

namespace Tests\Day5;

use Aoc2021\Day5\Day5;
use Tests\TestCase;

final class Day5Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day5())->part1($this->getTestInput());
		$this->assertSame($result, '5');
	}

	public function testPart2(): void
	{
		$result = (new Day5())->part2($this->getTestInput());
		$this->assertSame($result, '12');
	}
}
