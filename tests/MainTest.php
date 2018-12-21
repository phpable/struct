<?php
namespace Able\Struct\Tests;

use \PHPUnit\Framework\TestCase;

use \Able\Struct\Tests\Examples\StructA;
use \Able\Struct\Tests\Examples\StructB;
use \Able\Struct\Tests\Examples\StructC;
use \Able\Struct\Tests\Examples\StructD;

class MainTest extends TestCase {

	/**
	 * @throws \Exception
	 */
	public final function testCreateAndFillInstantly() {
		$Struct = new StructA('one', 'two', 'three');

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
	}

	/**
	 * @throws \Exception
	 */
	public final function testCreateAndFillLater() {
		$Struct = new StructA();

		$Struct->field2 = 'two';

		$this->assertEquals(null, $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals(null, $Struct->field3);

		$Struct->field1 = 'one';

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals(null, $Struct->field3);

		$Struct->field3 = 'three';

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
	}

	/**
	 * @throws \Exception
	 */
	public final function testExtendCreateAndFillInstantly() {
		$Struct = new StructB('one', 'two', 'three', 'four', 'five');

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
		$this->assertEquals('four', $Struct->field4);
		$this->assertEquals('five', $Struct->field5);
	}

	/**
	 * @throws \Exception
	 */
	public final function testSetters(){
		$Struct = new StructC('one', 'two', 'three', 'four', 'five');

		$this->assertEquals('more than one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
		$this->assertEquals('four', $Struct->field4);
		$this->assertEquals('less than five', $Struct->field5);
	}

	/**
	 * @throws \Exception
	 */
	public final function testGetters(){
		$Struct = new StructD('one', 'two', 'three', 'four', 'five');
		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two hundreds', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
		$this->assertEquals('four hundreds', $Struct->field4);
		$this->assertEquals('five', $Struct->field5);
	}
}
