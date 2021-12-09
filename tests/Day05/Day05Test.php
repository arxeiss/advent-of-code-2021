<?php

declare(strict_types=1);

namespace Tests\Day05;

use Aoc2021\Day05\Day05;
use Tests\TestCase;

final class Day05Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day05())->part1($this->getTestInput());
		$this->assertSame($result, '5');
	}

	public function testPart2(): void
	{
		$result = (new Day05())->part2($this->getTestInput());
		$this->assertSame($result, '12');
	}
}
