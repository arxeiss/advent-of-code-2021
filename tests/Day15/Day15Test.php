<?php

declare(strict_types=1);

namespace Tests\Day15;

use Aoc2021\Day15\Day15;
use Tests\TestCase;

final class Day15Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day15())->part1($this->getTestInput());
		$this->assertSame($result, '40');
	}

	public function testPart2(): void
	{
		$result = (new Day15())->part2($this->getTestInput());
		$this->assertSame($result, '315');
	}
}
