<?php

declare(strict_types=1);

namespace Tests\Day16;

use Aoc2021\Day16\Day16;
use Tests\TestCase;

final class Day16Test extends TestCase
{
	public function testPart1No1(): void
	{
		$result = (new Day16())->part1('8A004A801A8002F478');
		$this->assertSame($result, '16');
	}

	public function testPart1No2(): void
	{
		$result = (new Day16())->part1('620080001611562C8802118E34');
		$this->assertSame($result, '12');
	}

	public function testPart1No3(): void
	{
		$result = (new Day16())->part1('C0015000016115A2E0802F182340');
		$this->assertSame($result, '23');
	}

	public function testPart1No4(): void
	{
		$result = (new Day16())->part1('A0016C880162017C3686B18A3D4780');
		$this->assertSame($result, '31');
	}

	public function testPart2No1(): void
	{
		$result = (new Day16())->part2('C200B40A82');
		$this->assertSame($result, '3');
	}

	public function testPart2No2(): void
	{
		$result = (new Day16())->part2('04005AC33890');
		$this->assertSame($result, '54');
	}

	public function testPart2No3(): void
	{
		$result = (new Day16())->part2('880086C3E88112');
		$this->assertSame($result, '7');
	}

	public function testPart2No4(): void
	{
		$result = (new Day16())->part2('CE00C43D881120');
		$this->assertSame($result, '9');
	}

	public function testPart2No5(): void
	{
		$result = (new Day16())->part2('D8005AC2A8F0');
		$this->assertSame($result, '1');
	}

	public function testPart2No6(): void
	{
		$result = (new Day16())->part2('F600BC2D8F');
		$this->assertSame($result, '0');
	}

	public function testPart2No7(): void
	{
		$result = (new Day16())->part2('9C005AC2F8F0');
		$this->assertSame($result, '0');
	}

	public function testPart2No8(): void
	{
		$result = (new Day16())->part2('9C0141080250320F1802104A08');
		$this->assertSame($result, '1');
	}
}
