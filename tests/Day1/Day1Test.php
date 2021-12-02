<?php

namespace Tests\Day1;

use Aoc2021\Day1\Day1;
use PHPUnit\Framework\TestCase;

final class Day1Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day1())->part1(file_get_contents(__DIR__ . "/input.txt"));
		$this->assertSame($result, "7");
	}

	public function testPart2(): void
	{
		$result = (new Day1())->part2(file_get_contents(__DIR__ . "/input.txt"));
		$this->assertSame($result, "5");
	}
}
