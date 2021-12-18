<?php

declare(strict_types=1);

namespace Aoc2021\Day18;

use Aoc2021\Contracts\Runnable;
use Aoc2021\Day18\BinaryNode;
use Aoc2021\Day18\Node;
use Aoc2021\Day18\NumberNode;
use Aoc2021\Utils\Parser;

class Day18 implements Runnable
{
	public function part1(string $input): string
	{
		$c = Parser::getLines($input);

		[$n] = $this->buildTree($c[0]);

		$adds = $c->count();
		for ($i = 1; $i < $adds; $i += 1) {
			$n = new BinaryNode($n, $this->buildTree($c[$i])[0]);

			$action = true;
			while ($action === true) {
				$action = $this->explode($n);
				if ($action) {
					continue;
				}
				$action = $this->split($n);
			}
		}

		return (string)$n->magnitude();
	}

	public function part2(string $input): string
	{
		$c = Parser::getLines($input);
		$adds = $c->count();
		$maxMagnitude = 0;

		for ($p = 0; $p < $adds; $p += 1) {
			for ($i = 0; $i < $adds; $i += 1) {
				if ($p === $i) {
					continue;
				}
				$n = new BinaryNode($this->buildTree($c[$p])[0], $this->buildTree($c[$i])[0]);

				$action = true;
				while ($action === true) {
					$action = $this->explode($n);
					if ($action) {
						continue;
					}
					$action = $this->split($n);
				}

				$magnitude = $n->magnitude();
				if ($magnitude > $maxMagnitude) {
					$maxMagnitude = $magnitude;
				}
			}
		}

		return (string)$maxMagnitude;
	}

	/**
	 * @return array{Node, int}
	 */
	private function buildTree(string $input, int $offset = 1): array
	{
		$lNode = null;
		if ($input[$offset] === '[') {
			[$lNode, $offset] = $this->buildTree($input, $offset + 1);
		} else {
			$lNode = new NumberNode((int)$input[$offset]);
			$offset += 1;
		}

		if ($input[$offset] === ']') {
			return [$lNode, $offset + 1];
		}

		[$rNode, $offset] = $this->buildTree($input, $offset + 1);

		return [new BinaryNode($lNode, $rNode), $offset];
	}

	private function explode(BinaryNode $node, int $depth = 1): bool
	{
		if ($node->left instanceof BinaryNode && $this->explode($node->left, $depth + 1)) {
			return true;
		}
		if ($node->right instanceof BinaryNode && $this->explode($node->right, $depth + 1)) {
			return true;
		}
		if ($depth <= 4) {
			return false;
		}

		$isLeft = $node->parent->left === $node;
		if ($isLeft) {
			$this->findLeftNeighbour($node)?->addToNumber($node->left->number);
			$this->findRightNeighbour($node)?->addToNumber($node->right->number);
			$node->parent->left = new NumberNode(0, $node->parent);
		} else {
			$this->findRightNeighbour($node)?->addToNumber($node->right->number);
			$this->findLeftNeighbour($node)?->addToNumber($node->left->number);
			$node->parent->right = new NumberNode(0, $node->parent);
		}

		return true;
	}

	private function split(BinaryNode $node): bool
	{
		if ($node->left instanceof NumberNode) {
			if ($node->left->number > 9) {
				$node->left = new BinaryNode(
					new NumberNode((int)\floor($node->left->number / 2)),
					new NumberNode((int)\ceil($node->left->number / 2)),
					$node,
				);

				return true;
			}
		} elseif ($this->split($node->left)) {
			return true;
		}

		if ($node->right instanceof NumberNode) {
			if ($node->right->number > 9) {
				$node->right = new BinaryNode(
					new NumberNode((int)\floor($node->right->number / 2)),
					new NumberNode((int)\ceil($node->right->number / 2)),
					$node,
				);

				return true;
			}
		} elseif ($this->split($node->right)) {
			return true;
		}

		return false;
	}

	private function findLeftNeighbour(Node $node): ?NumberNode
	{
		$parent = $node->getParent();
		while ($parent !== null) {
			if ($parent->left !== $node) {
				return $parent->left->getMostRightLeaf();
			}
			$node = $node->parent;
			$parent = $node->getParent();
		}

		return null;
	}

	private function findRightNeighbour(Node $node): ?NumberNode
	{
		$parent = $node->getParent();
		while ($parent !== null) {
			if ($parent->right !== $node) {
				return $parent->right->getMostLeftLeaf();
			}
			$node = $node->parent;
			$parent = $node->getParent();
		}

		return null;
	}
}
