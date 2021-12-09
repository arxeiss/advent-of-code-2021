<?php

declare(strict_types=1);

namespace Aoc2021\Day08;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day08 implements Runnable
{
	public function part1(string $input): string
	{
		$codes = Parser::getLineElements($input, ' ')->map(static function (Collection $entry) {
				$result = $entry->slice(11, 4)->reduce(static fn ($acc, $d) => $acc + match (\strlen($d)) {
						2, 3, 4, 7 => 1,
						default => 0,
				}, 0);

				return $result;
		});

		return (string)$codes->sum();
	}

	public function part2(string $input): string
	{
		$sum = Parser::getLineElements($input, ' ')
			->map(function (Collection $entry) {
				$mapping = $this->getMapping($entry->slice(0, 10));

				$num = $entry->slice(11, 4)->reduce(static function ($acc, $n) use ($mapping) {
					$l = \strlen($n);

					return $acc . match (true) {
						$l === 6 && !\str_contains($n, $mapping['G']) => '0',
						$l === 2 => '1',
						$l === 5 && \str_contains($n, $mapping['B']) => \str_contains($n, $mapping['E']) ? '2' : '3',
						$l === 4 => '4',
						$l === 5 && \str_contains($n, $mapping['F']) => '5',
						$l === 6 => \str_contains($n, $mapping['B']) ? '9' : '6',
						$l === 3 => '7',
						$l === 7 => '8',
					};
				}, '');

				return (int)\ltrim($num, '0');
			})->sum();

		return (string)$sum;
	}

	/*
	 * In mapping I use differnt naming than in examples in AoC. My 7 segment is like this
	 *
	 *  aaaa
	 * f    b
	 * f    b
	 * f    b
	 *  gggg
	 * e    c
	 * e    c
	 * e    c
	 *  dddd
	 */

	private function getMapping(Collection $entry): Collection
	{
		$counting = new Collection(['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'f' => 0, 'g' => 0]);
		$one = $four = $seven = '';

		foreach ($entry as $cryptNumber) {
			$numLen = \strlen($cryptNumber);
			for ($i = 0; $i < $numLen; $i += 1) {
				$c = $cryptNumber[$i];
				$counting[$c] += 1;
			}
			[$one, $four, $seven] = match ($numLen) {
				2 => [$cryptNumber, $four, $seven],
				3 => [$one, $four, $cryptNumber],
				4 => [$one, $cryptNumber, $seven],
				default => [$one, $four, $seven]
			};
		}

		$mapping = new Collection([
			'A' => \str_replace(\str_split($one), '', $seven),
			'C' => $counting->keysByValue(9)[0],
			'E' => $counting->keysByValue(4)[0],
			'F' => $counting->keysByValue(6)[0],
		]);
		$mapping['B'] = $counting->keysByValue(8)->filter(static fn ($c) => $c !== $mapping['A'])->first();
		$mapping['G'] = \str_replace([$mapping['F'], $mapping['B'], $mapping['C']], '', $four);
		$mapping['D'] = $counting->keysByValue(7)->filter(static fn ($c) => $c !== $mapping['G'])->first();

		return $mapping;
	}
}
