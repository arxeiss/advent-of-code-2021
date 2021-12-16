<?php

declare(strict_types=1);

namespace Aoc2021\Day15;

class Vertex
{
	public string $id;

	/** @var array<array{Vertex, int}> */
	public array $edges = [];

	public function __construct(string $id)
	{
		$this->id = $id;
	}

	public function addEdge(Vertex $dest, int $cost): void
	{
		$this->edges[] = [$dest, $cost];
	}
}
