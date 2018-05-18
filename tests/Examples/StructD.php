<?php
namespace Able\Struct\Tests\Examples;

class StructD extends StructB {

	/**
	 * @param string $value
	 * @return string
	 */
	public final function getField2Property(string $value){
		return $value . ' hundreds';
	}

	/**
	 * @param string $value
	 * @return string
	 */
	public final function getField4Property(string $value){
		return $value . ' hundreds';
	}
}
