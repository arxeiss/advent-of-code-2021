<?php

declare(strict_types=1);

namespace Aoc2021\Day04;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Collection;
use Aoc2021\Utils\Parser;

class Day04 implements Runnable
{
	public function part1(string $input): string
	{
		$elements = Parser::getElements($input, "\n\n");

		$numbers = Parser::getElements($elements->shift(), ',');
		$games = $elements->map(static fn ($el) => Parser::getLineElements($el));

		$numCount = $numbers->count();
		for ($i = 0; $i < $numCount; $i += 1) {
			foreach ($games as $game) {
				$this->handleNextNumber($game, $numbers[$i]);
				if ($this->checkWiner($game)) {
					$result = $game->flatten()->filter(static fn ($e) => $e !== 'X')->sum() * (int)$numbers[$i];

					return (string)$result;
				}
			}
		}

		return 'fail';
	}

	public function part2(string $input): string
	{
		$elements = Parser::getElements($input, "\n\n");

		$numbers = Parser::getElements($elements->shift(), ',');
		$games = $elements->map(static fn ($el) => Parser::getLineElements($el));
		$lastWinnerResult = 'fail';

		$numCount = $numbers->count();
		for ($i = 0; $i < $numCount; $i += 1) {
			foreach ($games as $gi => $game) {
				if ($game === null) {
					continue;
				}

				$this->handleNextNumber($game, $numbers[$i]);
				if ($this->checkWiner($game)) {
					$lastWinnerResult = $game->flatten()->filter(static fn ($e) => $e !== 'X')->sum();
					$lastWinnerResult *= (int)$numbers[$i];
					$games[$gi] = null;
				}
			}
		}

		return (string)$lastWinnerResult;
	}

	private function handleNextNumber(Collection $game, string $number): void
	{
		foreach ($game as $y => $row) {
			foreach ($row as $x => $el) {
				if ($el === $number) {
					$game[$y][$x] = 'X';
				}
			}
		}
	}

	private function checkWiner(Collection $game): bool
	{
		// Check rows
		$rows = $game->count();
		for ($y = 0; $y < $rows; $y += 1) {
			$cols = $game[$y]->count();
			$xInRows = 0;
			for ($x = 0; $x < $cols; $x += 1) {
				if ($game[$y][$x] === 'X') {
					$xInRows += 1;
				}
			}
			if ($xInRows === $cols) {
				return true;
			}
		}

		// Check cols
		$cols = $game[0]->count();
		for ($x = 0; $x < $cols; $x += 1) {
			$rows = $game->count();
			$xInCol = 0;
			for ($y = 0; $y < $rows; $y += 1) {
				if ($game[$y][$x] === 'X') {
					$xInCol += 1;
				}
			}
			if ($xInCol === $rows) {
				return true;
			}
		}

		return false;
	}
}
