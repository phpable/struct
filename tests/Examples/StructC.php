<?php
namespace Able\Struct\Tests\Examples;

class StructC extends StructB {

	/**
	 * @const string
	 */
	const defaultField1Value = '';

	/**
	 * @param string $value
	 * @return string
	 */
	public final function setField1Property(string $value){
		return 'more than ' . $value;
	}

	/**
	 * @param string|null $value
	 * @return string
	 */
	public final function setField5Property(?string $value){
		return 'less than ' . $value;
	}

}
