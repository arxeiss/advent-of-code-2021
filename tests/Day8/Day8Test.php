<?php

declare(strict_types=1);

namespace Tests\Day8;

use Aoc2021\Day8\Day8;
use Tests\TestCase;

final class Day8Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day8())->part1($this->getTestInput());
		$this->assertSame($result, '26');
	}

	public function testPart2(): void
	{
		$result = (new Day8())->part2($this->getTestInput());
		$this->assertSame($result, '61229');
	}

	public function testPart2Small(): void
	{
		$result = (new Day8())->part2(
			'acedgfb cdfbe gcdfa fbcad dab cefabd cdfgeb eafb cagedb ab | cdfeb fcadb cdfeb cdbaf',
		);
		$this->assertSame($result, '5353');
	}
}
