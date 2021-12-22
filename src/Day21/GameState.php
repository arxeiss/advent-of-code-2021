<?php

declare(strict_types=1);

namespace Aoc2021\Day21;

class GameState
{
	public int $p1Pos;
	public int $p1Score;
	public int $p2Pos;
	public int $p2Score;

	public function __construct(int $p1Pos, int $p1Score, int $p2Pos, int $p2Score)
	{
		$this->p1Pos = $p1Pos;
		$this->p1Score = $p1Score;
		$this->p2Pos = $p2Pos;
		$this->p2Score = $p2Score;
	}

	public function ID(): string
	{
		return \sprintf('%d:%d:%d:%d', $this->p1Pos, $this->p1Score, $this->p2Pos, $this->p2Score);
	}

	public function __toString(): string
	{
		return $this->ID();
	}
}
