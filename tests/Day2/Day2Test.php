<?php

declare(strict_types=1);

namespace Tests\Day2;

use Aoc2021\Day2\Day2;
use Tests\TestCase;

final class Day2Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day2())->part1($this->getTestInput());
		$this->assertSame($result, '150');
	}

	public function testPart2(): void
	{
		$result = (new Day2())->part2($this->getTestInput());
		$this->assertSame($result, '900');
	}
}
