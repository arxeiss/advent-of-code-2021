<?php

declare(strict_types=1);

namespace Tests\Day20;

use Aoc2021\Day20\Day20;
use Tests\TestCase;

final class Day20Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day20())->part1($this->getTestInput());
		$this->assertSame($result, '35');
	}

	public function testPart2(): void
	{
		$result = (new Day20())->part2($this->getTestInput());
		$this->assertSame($result, '3351');
	}
}
