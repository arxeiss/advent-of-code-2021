<?php

declare(strict_types=1);

namespace Tests\Day03;

use Aoc2021\Day03\Day03;
use Tests\TestCase;

final class Day03Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day03())->part1($this->getTestInput());
		$this->assertSame($result, '198');
	}

	public function testPart2(): void
	{
		$result = (new Day03())->part2($this->getTestInput());
		$this->assertSame($result, '230');
	}
}
