<?php
namespace Able\Struct\Tests\Examples;

use \Able\Struct\AStruct;

class StructA extends AStruct {

	/**
	 * @const string
	 */
	protected const defaultfield3Value = 'f3';

	/**
	 * @var array
	 */
	protected static array $Prototype = ['field1', 'field2', 'field3'];
}
