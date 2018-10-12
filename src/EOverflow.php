<?php
namespace Able\Struct;

use \Able\Exceptions\Abstractions\AException;

class EOverflow extends AException {

	/**
	 * @var string
	 */
	protected static string $template = 'Too many arguments passed to the structure: %d expected but %d given.';

	/**
	 * EArgumentsMismatch constructor.
	 * @param int $expected
	 * @param int $given
	 * @param Throwable|null $Previous
	 */
	public function __construct(int $expected, int $given, ?Throwable $Previous = null) {
		parent::__construct(func_get_args());
	}
}
