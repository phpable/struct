<?php
namespace Able\Struct\Exceptions;

use \Able\Exceptions\EOverflow;

class EDataOverflow extends EOverflow {

	/**
	 * @var string
	 */
	protected static string $template = 'Too many arguments passed: %d expected but %d given!';
}
