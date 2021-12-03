<?php

declare(strict_types=1);

namespace Tests\Day1;

use Aoc2021\Day1\Day1;
use Tests\TestCase;

final class Day1Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day1())->part1($this->getTestInput());
		$this->assertSame($result, '7');
	}

	public function testPart2(): void
	{
		$result = (new Day1())->part2($this->getTestInput());
		$this->assertSame($result, '5');
	}
}
