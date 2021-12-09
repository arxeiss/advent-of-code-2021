<?php

declare(strict_types=1);

namespace Tests\Day01;

use Aoc2021\Day01\Day01;
use Tests\TestCase;

final class Day01Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day01())->part1($this->getTestInput());
		$this->assertSame($result, '7');
	}

	public function testPart2(): void
	{
		$result = (new Day01())->part2($this->getTestInput());
		$this->assertSame($result, '5');
	}
}
