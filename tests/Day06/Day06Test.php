<?php

declare(strict_types=1);

namespace Tests\Day06;

use Aoc2021\Day06\Day06;
use Tests\TestCase;

final class Day06Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day06())->part1($this->getTestInput());
		$this->assertSame($result, '5934');
	}

	public function testPart2(): void
	{
		$result = (new Day06())->part2($this->getTestInput());
		$this->assertSame($result, '26984457539');
	}
}
