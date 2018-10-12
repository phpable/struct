<?php
namespace Able\Struct;

use \Able\Exceptions\Abstractions\AException;

class EInvalidFieldName extends AException {

	/**
	 * @var string
	 */
	protected static string $template = 'Invalid or empty structure field name: %s!';

	/**
	 * @param string $name
	 * @param Throwable|null $Previous
	 */
	public function __construct(string $name, ?Throwable $Previous = null) {
		parent::__construct(func_get_args());
	}
}
