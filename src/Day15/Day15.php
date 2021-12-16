<?php

declare(strict_types=1);

namespace Aoc2021\Day15;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Day15\Vertex;
use Aoc2021\Utils\Parser;

class Day15 implements Runnable
{
	public function part1(string $input): string
	{
		$lines = Parser::getLines($input);
		$rows = $lines->count();
		$cols = \strlen($lines[0]);

		/** @var array<string, Vertex> $graph */
		$graph = [];
		$lengths = [];
		$nonProcessed = [];
		for ($r = 0; $r < $rows; $r += 1) {
			for ($c = 0; $c < $cols; $c += 1) {
				$i = "{$r}:{$c}";
				$nonProcessed[$i] = true;
				$graph[$i] = new Vertex($i);
				$lengths[$i] = \PHP_INT_MAX;
			}
		}
		$lengths['0:0'] = 0;

		for ($r = 0; $r < $rows; $r += 1) {
			for ($c = 0; $c < $cols; $c += 1) {
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

		$lengths = $this->getShortestPaths($lengths, $graph, $nonProcessed);

		$end = ($rows - 1) . ':' . ($cols - 1);

		return (string)$lengths[$end];
	}

	public function part2(string $input): string
	{
		$lines = Parser::getLines($input);
		$smallRows = $lines->count();
		$smallCols = \strlen($lines[0]);
		$rows = $smallRows * 5;
		$cols = $smallCols * 5;

		/** @var array<string, Vertex> $graph */
		$graph = [];
		$lengths = [];
		$nonProcessed = [];
		for ($r = 0; $r < $rows; $r += 1) {
			for ($c = 0; $c < $cols; $c += 1) {
				$i = "{$r}:{$c}";
				$nonProcessed[$i] = true;
				$graph[$i] = new Vertex($i);
				$lengths[$i] = \PHP_INT_MAX;
			}
		}
		$lengths['0:0'] = 0;

		for ($r = 0; $r < $rows; $r += 1) {
			for ($c = 0; $c < $cols; $c += 1) {
				$v = $graph["{$r}:{$c}"];
				foreach ([[-1, 0], [0, -1], [1, 0], [0, 1]] as [$ro, $co]) {
					$rt = $r + $ro;
					$ct = $c + $co;
					if (0 <= $rt && $rt < $rows && 0 <= $ct && $ct < $cols) {
						$cost = (int)$lines[$rt % $smallRows][$ct % $smallCols];
						$cost += \floor($rt / $smallRows) + \floor($ct / $smallCols);

						$v->addEdge($graph["{$rt}:{$ct}"], (int)($cost <= 9 ? $cost : $cost - 9));
					}
				}
			}
		}

		$lengths = $this->getShortestPaths($lengths, $graph, $nonProcessed);

		return (string)$lengths[($rows - 1) . ':' . ($cols - 1)];
	}

	/**
	 * @param  array<string, int>    $lengths
	 * @param  array<string, Vertex> $graph
	 * @param  array<string, bool>   $nonProcessed
	 * @return array<string, int>
	 */
	private function getShortestPaths(array $lengths, array $graph, array $nonProcessed): array
	{
		$toCheck = [];
		unset($nonProcessed['0:0']);

		foreach ($graph['0:0']->edges as [$v, $c]) {
			if (!isset($nonProcessed[$v->id])) {
				continue;
			}
			$toCheck[$v->id] = true;
			$lengths[$v->id] = $c;
		}

		while (\count($nonProcessed) > 0) {
			$minLength = \PHP_INT_MAX;
			$minIndex = '';
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
				if ($minLength + $c < $lengths[$v->id]) {
					$lengths[$v->id] = $minLength + $c;
				}
			}
		}

		return $lengths;
	}
}
