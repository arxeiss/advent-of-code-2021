<?php

declare(strict_types=1);

namespace Tests\Day7;

use Aoc2021\Day7\Day7;
use Tests\TestCase;

final class Day7Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day7())->part1($this->getTestInput());
		$this->assertSame($result, '37');
	}

	public function testPart2(): void
	{
		$result = (new Day7())->part2($this->getTestInput());
		$this->assertSame($result, '168');
	}
}
