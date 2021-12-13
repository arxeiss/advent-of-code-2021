<?php

declare(strict_types=1);

namespace Tests\Day13;

use Aoc2021\Day13\Day13;
use Tests\TestCase;

final class Day13Test extends TestCase
{
	public function testPart1(): void
	{
		$result = (new Day13())->part1($this->getTestInput());
		$this->assertSame($result, '17');
	}

	public function testPart2(): void
	{
		$result = (new Day13())->part2($this->getTestInput());
		//phpcs:ignore Squiz.PHP.Heredoc.NotAllowed
		$expected = <<<END

			#####
			#   #
			#   #
			#   #
			#####

			END;
		$this->assertSame($result, $expected);
	}
}
