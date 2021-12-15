<?php

declare(strict_types=1);

namespace Aoc2021\Day15;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Utils\Parser;

class Vertex
{
	public string $id;
	/** @var array<array{Vertex, int}> */
	public array $edges = [];

	public function __construct(string $id)
	{
		$this->id = $id;
	}

	public function addEdge(Vertex $dest, int $cost)
	{
		$this->edges[] = [$dest, $cost];
	}
}

class Day15 implements Runnable
{
	public function part1(string $input): string
	{
		$lines = Parser::getLines($input);
		$rows = $lines->count();
		$cols = strlen($lines[0]);

		/** @var array<Vertex> */
		$graph = [];
		$lengths = [];
		$nonProcessed = [];
		for ($r = 0; $r < $rows; $r++) {
			for ($c = 0; $c < $cols; $c++) {
				$i = "{$r}:{$c}";
				$nonProcessed[$i] = true;
				$graph[$i] = new Vertex($i);
				$lengths[$i] = \PHP_INT_MAX;
			}
		}
		$lengths["0:0"] = 0;

		for ($r = 0; $r < $rows; $r++) {
			for ($c = 0; $c < $cols; $c++) {
				$v = $graph["{$r}:{$c}"];
				foreach ([[-1, 0], [0, -1], [1, 0], [0, 1]] as [$ro, $co]) {
					$rt = $r + $ro;
					$ct = $c + $co;
					if (0 <= $rt && $rt < $rows && 0 <= $ct && $ct < $cols) {
						$v->addEdge($graph["{$rt}:{$ct}"], (int)$lines[$rt][$ct]);
					}
				}
			}
		}

		$toCheck = [];
		unset($nonProcessed["0:0"]);

		foreach ($graph["0:0"]->edges as [$v, $c]) {
			if (!isset($nonProcessed[$v->id])) {
				continue;
			}
			$toCheck[$v->id] = true;
			$lengths[$v->id] = $c;
		}

		while (count($nonProcessed) > 0) {
			$minLength = PHP_INT_MAX;
			$minIndex = "";
			foreach ($toCheck as $index => $v) {
				if ($lengths[$index] < $minLength) {
					$minLength = $lengths[$index];
					$minIndex = $index;
				}
			}

			unset($nonProcessed[$minIndex]);
			unset($toCheck[$minIndex]);

			foreach ($graph[$minIndex]->edges as [$v, $c]) {
				if (!isset($nonProcessed[$v->id])) {
					continue;
				}
				$toCheck[$v->id] = true;
				$totalCost = $minLength + $c;
				if ($totalCost < $lengths[$v->id]) {
					$lengths[$v->id] = $totalCost;
				}
			}
		}

		$end = ($rows - 1) . ":" . ($cols - 1);
		return (string)$lengths[$end];
	}

	public function part2(string $input): string
	{
		$lines = Parser::getLines($input);
		$smallRows = $lines->count();
		$smallCols = strlen($lines[0]);
		$rows = $smallRows * 5;
		$cols = $smallCols * 5;

		/** @var array<Vertex> */
		$graph = [];
		$lengths = [];
		$nonProcessed = [];
		for ($r = 0; $r < $rows; $r++) {
			for ($c = 0; $c < $cols; $c++) {
				$i = "{$r}:{$c}";
				$nonProcessed[$i] = true;
				$graph[$i] = new Vertex($i);
				$lengths[$i] = \PHP_INT_MAX;
			}
		}
		$lengths["0:0"] = 0;

		for ($r = 0; $r < $rows; $r++) {
			for ($c = 0; $c < $cols; $c++) {
				$v = $graph["{$r}:{$c}"];
				foreach ([[-1, 0], [0, -1], [1, 0], [0, 1]] as [$ro, $co]) {
					$rt = $r + $ro;
					$ct = $c + $co;
					if (0 <= $rt && $rt < $rows && 0 <= $ct && $ct < $cols) {
						$initialCost = (int)$lines[$rt % $smallRows][$ct % $smallCols];
						$initialCost += floor($rt / $smallRows);
						$initialCost += floor($ct / $smallCols);
						if ($initialCost > 9) {
							$initialCost -= 9;
						}
						$v->addEdge($graph["{$rt}:{$ct}"], (int)$initialCost);
					}
				}
			}
		}

		$toCheck = [];
		unset($nonProcessed["0:0"]);

		foreach ($graph["0:0"]->edges as [$v, $c]) {
			if (!isset($nonProcessed[$v->id])) {
				continue;
			}
			$toCheck[$v->id] = true;
			$lengths[$v->id] = $c;
		}

		while (count($nonProcessed) > 0) {
			$minLength = PHP_INT_MAX;
			$minIndex = "";
			foreach ($toCheck as $index => $v) {
				if ($lengths[$index] < $minLength) {
					$minLength = $lengths[$index];
					$minIndex = $index;
				}
			}

			unset($nonProcessed[$minIndex]);
			unset($toCheck[$minIndex]);

			foreach ($graph[$minIndex]->edges as [$v, $c]) {
				if (!isset($nonProcessed[$v->id])) {
					continue;
				}
				$toCheck[$v->id] = true;
				$totalCost = $minLength + $c;
				if ($totalCost < $lengths[$v->id]) {
					$lengths[$v->id] = $totalCost;
				}
			}
		}

		$end = ($rows - 1) . ":" . ($cols - 1);
		return (string)$lengths[$end];
	}
}
