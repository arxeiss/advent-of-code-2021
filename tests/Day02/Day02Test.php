<?php

declare(strict_types=1);

namespace Tests\Day02;

use Aoc2021\Day02\Day02;
use Tests\TestCase;

final class Day02Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day02())->part1($this->getTestInput());
		$this->assertSame($result, '150');
	}

	public function testPart2(): void
	{
		$result = (new Day02())->part2($this->getTestInput());
		$this->assertSame($result, '900');
	}
}
