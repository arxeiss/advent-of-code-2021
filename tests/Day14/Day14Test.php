<?php

declare(strict_types=1);

namespace Tests\Day14;

use Aoc2021\Day14\Day14;
use Tests\TestCase;

final class Day14Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day14())->part1($this->getTestInput());
		$this->assertSame($result, '1588');
	}

	public function testPart2(): void
	{
		$result = (new Day14())->part2($this->getTestInput());
		$this->assertSame($result, '2188189693529');
	}
}
