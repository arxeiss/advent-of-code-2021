<?php

declare(strict_types=1);

namespace Tests\Day18;

use Aoc2021\Day18\Day18;
use Tests\TestCase;

final class Day18Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day18())->part1($this->getTestInput());
		$this->assertSame($result, '4140');
	}

	public function testPart2(): void
	{
		$this->markTestSkipped();
		$result = (new Day18())->part2($this->getTestInput());
		$this->assertSame($result, '3993');
	}
}
