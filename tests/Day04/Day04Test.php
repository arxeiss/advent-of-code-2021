<?php

declare(strict_types=1);

namespace Tests\Day04;

use Aoc2021\Day04\Day04;
use Tests\TestCase;

final class Day04Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day04())->part1($this->getTestInput());
		$this->assertSame($result, '4512');
	}

	public function testPart2(): void
	{
		$result = (new Day04())->part2($this->getTestInput());
		$this->assertSame($result, '1924');
	}
}
