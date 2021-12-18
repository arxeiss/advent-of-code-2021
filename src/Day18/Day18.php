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
		[$left] = $this->buildTree($c[0]);
		$this->linkLeafs($left);

		// echo "\n\n" . $left . "\n\n";

		$adds = $c->count();
		for ($i = 1; $i < $adds; $i += 1) {
			[$right] = $this->buildTree($c[$i]);
			$this->linkLeafs($right);
			$rl = $left->getMostRightLeaf();
			$lf = $right->getMostLeftLeaf();

			$rl->next = $lf;
			$lf->previous = $rl;

			$left = new BinaryNode($left, $right);
			// echo $left . "\n\n";

			$action = true;
			while ($action === true) {
				$action = $this->explode($left);
				if ($action) {
					// echo "Explode:\n" . $left . "\n\n";
					continue;
				}
				$action = $this->split($left);
				if ($action) {
					// echo "Split:\n" . $left . "\n\n";
				}
			}

			// echo $left . "\n\n";
		}

		return (string)$left->magnitude();
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
				[$left] = $this->buildTree($c[$p]);
				$this->linkLeafs($left);
				[$right] = $this->buildTree($c[$i]);
				$this->linkLeafs($right);

				$rl = $left->getMostRightLeaf();
				$lf = $right->getMostLeftLeaf();

				$rl->next = $lf;
				$lf->previous = $rl;

				$n = new BinaryNode($left, $right);

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

	private function linkLeafs(BinaryNode $rootNode)
	{
		$current = $rootNode->getMostLeftLeaf();
		while (($next = $this->findRightNeighbour($current)) !== null) {
			$current->next = $next;
			$next->previous = $current;

			$current = $next;
		}
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
			$node->left->previous?->addToNumber($node->left->number);
			$node->right->next?->addToNumber($node->right->number);

			$nn = new NumberNode(0, $node->parent);
			$nn->previous = $node->left->previous;
			$nn->next = $node->right->next;

			$node->left->previous?->setNext($nn);
			$node->right->next?->setPrevious($nn);
			$node->parent->left = $nn;
		} else {
			$node->left->previous?->addToNumber($node->left->number);
			$node->right->next?->addToNumber($node->right->number);

			$nn = new NumberNode(0, $node->parent);
			$nn->previous = $node->left->previous;
			$nn->next = $node->right->next;

			$node->left->previous?->setNext($nn);
			$node->right->next?->setPrevious($nn);
			$node->parent->right = $nn;
		}

		return true;
	}

	private function split(BinaryNode $node): bool
	{
		if ($node->left instanceof NumberNode) {
			if ($node->left->number > 9) {
				$l = new NumberNode((int)\floor($node->left->number / 2));
				$r = new NumberNode((int)\ceil($node->left->number / 2));

				$l->next = $r;
				$r->previous = $l;
				$l->previous = $node->left->previous;
				$r->next = $node->left->next;

				$node->left->previous?->setNext($l);
				$node->left->next?->setPrevious($r);

				$node->left = new BinaryNode($l, $r, $node);

				return true;
			}
		} elseif ($this->split($node->left)) {
			return true;
		}

		if ($node->right instanceof NumberNode) {
			if ($node->right->number > 9) {
				$l = new NumberNode((int)\floor($node->right->number / 2));
				$r = new NumberNode((int)\ceil($node->right->number / 2));

				$l->next = $r;
				$r->previous = $l;
				$l->previous = $node->right->previous;
				$r->next = $node->right->next;

				$node->right->previous?->setNext($l);
				$node->right->next?->setPrevious($r);

				$node->right = new BinaryNode($l, $r, $node);

				return true;
			}
		} elseif ($this->split($node->right)) {
			return true;
		}

		return false;
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
