<?php
namespace Able\Struct\Tests\Examples;

class StructC extends StructB {

	/**
	 * @param string $value
	 * @return string
	 */
	public final function setField1Property($value){
		return 'more than ' . $value;
	}

	/**
	 * @param string $value
	 * @return string
	 */
	public final function setField5Property($value){
		return 'less than ' . $value;
	}

}
