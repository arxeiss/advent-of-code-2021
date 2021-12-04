<?php

declare(strict_types=1);

namespace Tests\Day4;

use Aoc2021\Day4\Day4;
use Tests\TestCase;

final class Day4Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day4())->part1($this->getTestInput());
		$this->assertSame($result, '4512');
	}

	public function testPart2(): void
	{
		$result = (new Day4())->part2($this->getTestInput());
		$this->assertSame($result, '1924');
	}
}
