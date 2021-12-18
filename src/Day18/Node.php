<?php

declare(strict_types=1);

namespace Aoc2021\Day18;

use Aoc2021\Day18\BinaryNode;
use Aoc2021\Day18\NumberNode;

interface Node
{
	public function magnitude(): int;

	public function setParent(BinaryNode $node): void;

	public function getParent(): ?BinaryNode;

	public function getMostLeftLeaf(): NumberNode;

	public function getMostRightLeaf(): NumberNode;

	public function __toString(): string;
}
