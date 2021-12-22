<?php

declare(strict_types=1);

namespace Tests\Day21;

use Aoc2021\Day21\Day21;
use Tests\TestCase;

final class Day21Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day21())->part1($this->getTestInput());
		$this->assertSame($result, '739785');
	}

	public function testPart2(): void
	{
		$result = (new Day21())->part2($this->getTestInput());
		$this->assertSame($result, '444356092776315');
	}
}
