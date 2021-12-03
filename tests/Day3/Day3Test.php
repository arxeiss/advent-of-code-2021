<?php

declare(strict_types=1);

namespace Tests\Day3;

use Aoc2021\Day3\Day3;
use Tests\TestCase;

final class Day3Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day3())->part1($this->getTestInput());
		$this->assertSame($result, '198');
	}

	public function testPart2(): void
	{
		$result = (new Day3())->part2($this->getTestInput());
		$this->assertSame($result, '230');
	}
}
