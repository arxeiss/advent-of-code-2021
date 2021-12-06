<?php

declare(strict_types=1);

namespace Tests\Day6;

use Aoc2021\Day6\Day6;
use Tests\TestCase;

final class Day6Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day6())->part1($this->getTestInput());
		$this->assertSame($result, '5934');
	}

	public function testPart2(): void
	{
		$result = (new Day6())->part2($this->getTestInput());
		$this->assertSame($result, '26984457539');
	}
}
