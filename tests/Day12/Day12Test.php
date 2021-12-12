<?php

declare(strict_types=1);

namespace Tests\Day12;

use Aoc2021\Day12\Day12;
use Tests\TestCase;

final class Day12Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day12())->part1($this->getTestInput());
		$this->assertSame($result, '226');
	}

	public function testPart1Middle(): void
	{
		$result = (new Day12())->part1($this->getTestInput('middle'));
		$this->assertSame($result, '19');
	}

	public function testPart1Small(): void
	{
		$result = (new Day12())->part1($this->getTestInput('small'));
		$this->assertSame($result, '10');
	}

	public function testPart2Small(): void
	{
		$result = (new Day12())->part2($this->getTestInput('small'));
		$this->assertSame($result, '36');
	}

	public function testPart2Middle(): void
	{
		$result = (new Day12())->part2($this->getTestInput('middle'));
		$this->assertSame($result, '103');
	}

	public function testPart2(): void
	{
		$result = (new Day12())->part2($this->getTestInput());
		$this->assertSame($result, '3509');
	}
}
