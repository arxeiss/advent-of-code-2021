<?php

declare(strict_types=1);

namespace Aoc2021\Day18;

use Aoc2021\Day18\BinaryNode;
use Aoc2021\Day18\Node;

class NumberNode implements Node
{
	public int $number;
	public ?BinaryNode $parent;

	public ?NumberNode $previous = null;
	public ?NumberNode $next = null;

	public function __construct(int $number, ?BinaryNode $parent = null)
	{
		$this->number = $number;
		$this->parent = $parent;
	}

	public function magnitude(): int
	{
		return $this->number;
	}

	public function addToNumber(int $add): void
	{
		$this->number += $add;
	}

	public function setParent(BinaryNode $node): void
	{
		$this->parent = $node;
	}

	public function getMostLeftLeaf(): NumberNode
	{
		return $this;
	}

	public function getMostRightLeaf(): NumberNode
	{
		return $this;
	}

	public function getParent(): ?BinaryNode
	{
		return $this->parent;
	}

	public function setPrevious(NumberNode $node)
	{
		$this->previous = $node;
	}

	public function setNext(NumberNode $node)
	{
		$this->next = $node;
	}

	public function __toString(): string
	{
		return "(" . $this->previous?->number . "<=" . $this->number . "=>" . $this->next?->number . ")";
	}
}
