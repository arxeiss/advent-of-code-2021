<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
	public function getTestInput(string $type = ''): string
	{
		$caller = \explode('\\', static::class, 3);

		if ($type !== '') {
			$type = '-' . $type;
		}

		return \file_get_contents(__DIR__ . "/{$caller[1]}/input{$type}.txt");
	}
}
