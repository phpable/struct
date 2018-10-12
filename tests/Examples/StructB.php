<?php
namespace Able\Struct\Tests\Examples;

class StructB extends StructA {

	protected const defaultField4Value = 'f4';

	/**
	 * @var array
	 */
	protected static array $Prototype = ['field4', 'field5'];

}
