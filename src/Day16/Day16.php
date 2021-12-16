<?php

declare(strict_types=1);

namespace Aoc2021\Day16;

use Aoc2021\Contracts\Runnable;

class Day16 implements Runnable
{
	public function part1(string $input): string
	{
		[, , $version] = $this->decode($this->parse($input), 0);

		return (string)$version;
	}

	public function part2(string $input): string
	{
		[$n] = $this->decode($this->parse($input), 0);

		return (string)$n;
	}

	private function parse(string $input): string
	{
		$c = [
			'0' => '0000',
			'1' => '0001',
			'2' => '0010',
			'3' => '0011',
			'4' => '0100',
			'5' => '0101',
			'6' => '0110',
			'7' => '0111',
			'8' => '1000',
			'9' => '1001',
			'a' => '1010',
			'b' => '1011',
			'c' => '1100',
			'd' => '1101',
			'e' => '1110',
			'f' => '1111',
		];

		return \str_replace(\array_keys($c), \array_values($c), \strtolower(\trim($input)));
	}

	/**
	 * @return array{int, int, int}
	 */
	private function decode(string $input, int $offset): array
	{
		$version = (int)\bindec(\substr($input, $offset, 3));
		$offset += 3;
		$type = (int)\bindec(\substr($input, $offset, 3));
		$offset += 3;

		if ($type === 4) {
			$n = '';
			$continue = true;
			while ($continue) {
				$continue = $input[$offset] === '1';
				$n .= \substr($input, $offset + 1, 4);
				$offset += 5;
			}

			return [(int)\bindec($n), $offset, $version];
		}

		return $this->decodeOperation($version, $type, $input, $offset);
	}

	/**
	 * @return array{int, int, int}
	 */
	private function decodeOperation(int $version, int $type, string $input, int $offset): array
	{
		$l = $input[$offset] === '0' ? 15 : 11;
		$size = \bindec(\substr($input, $offset + 1, $l));
		$offset += $l + 1;
		$elems = [];

		if ($l === 15) {
			$endOfsset = $offset + $size;
			while ($offset < $endOfsset) {
				[$n, $offset, $v] = $this->decode($input, $offset);
				$version += $v;
				$elems[] = $n;
			}
		} else {
			for ($i = 0; $i < $size; $i += 1) {
				[$n, $offset, $v] = $this->decode($input, $offset);
				$version += $v;
				$elems[] = $n;
			}
		}

		$n = match ($type) {
			0 => \array_sum($elems),
			1 => \array_product($elems),
			2 => \min($elems),
			3 => \max($elems),
			5 => $elems[0] > $elems[1] ? 1 : 0,
			6 => $elems[0] < $elems[1] ? 1 : 0,
			7 => $elems[0] === $elems[1] ? 1 : 0,
		};

		return [$n, $offset, $version];
	}
}
