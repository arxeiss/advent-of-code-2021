<?php

declare(strict_types=1);

namespace Tests\Day10;

use Aoc2021\Day10\Day10;
use Tests\TestCase;

final class Day10Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day10())->part1($this->getTestInput());
		$this->assertSame($result, '26397');
	}

	public function testPart2(): void
	{
		$result = (new Day10())->part2($this->getTestInput());
		$this->assertSame($result, '288957');
	}
}
