<?php

declare(strict_types=1);

namespace Aoc2021\Day18;

class BinaryNode implements Node
{
	public Node $left;
	public Node $right;
	public ?BinaryNode $parent;

	public function __construct(Node $left, Node $right, ?BinaryNode $parent = null)
	{
		$this->left = $left;
		$this->right = $right;
		$this->parent = $parent;

		$this->left->setParent($this);
		$this->right->setParent($this);
	}

	public function magnitude(): int
	{
		return 3 * $this->left->magnitude() + 2 * $this->right->magnitude();
	}

	public function setParent(BinaryNode $node): void
	{
		$this->parent = $node;
	}

	public function getMostLeftLeaf(): NumberNode
	{
		return $this->left->getMostLeftLeaf();
	}

	public function getMostRightLeaf(): NumberNode
	{
		return $this->right->getMostRightLeaf();
	}

	public function getParent(): ?BinaryNode
	{
		return $this->parent;
	}

	public function __toString(): string
	{
		return '[' . $this->left->__toString() . ',' . $this->right->__toString() . ']';
	}
}
