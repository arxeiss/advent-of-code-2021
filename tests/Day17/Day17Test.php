<?php

declare(strict_types=1);

namespace Tests\Day17;

use Aoc2021\Day17\Day17;
use Tests\TestCase;

final class Day17Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day17())->part1($this->getTestInput());
		$this->assertSame($result, '45');
	}

	public function testPart2(): void
	{
		$result = (new Day17())->part2($this->getTestInput());
		$this->assertSame($result, '112');
	}
}
