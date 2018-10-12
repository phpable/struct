<?php
namespace Able\Struct\Exceptions;

use \Able\Exceptions\Abstractions\AException;

class EUndefinedField extends AException {

	/**
	 * @var string
	 */
	protected static string $template = 'Undefined structure field "%s"!';

	/**
	 * @param string $name
	 * @param Throwable|null $Previous
	 */
	public function __construct(string $name, ?Throwable $Previous = null) {
		parent::__construct(func_get_args());
	}
}
