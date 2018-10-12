<?php
namespace Able\Struct\Tests;

use \PHPUnit\Framework\TestCase;

use \Able\Struct\Tests\Examples\StructA;
use \Able\Struct\Tests\Examples\StructB;
use \Able\Struct\Tests\Examples\StructC;
use \Able\Struct\Tests\Examples\StructD;
use \Able\Struct\Tests\Examples\StructE;

use \Able\Struct\EUndefinedField;
use \Able\Struct\EInvalidFieldName;

class MainTest extends TestCase {

	public final function testCreateAndFillInstantly() {
		$Struct = new StructA('one', 'two', 'three');

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
	}

	public final function testCreateAndFillLater() {
		$Struct = new StructA();

		$Struct->field2 = 'two';

		$this->assertEquals(null, $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('f3', $Struct->field3);

		$Struct->field1 = 'one';

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('f3', $Struct->field3);

		$Struct->field3 = 'three';

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
	}

	public final function testExtendCreateAndFillInstantly() {
		$Struct = new StructB('one', 'two', 'three', 'four', 'five');

		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
		$this->assertEquals('four', $Struct->field4);
		$this->assertEquals('five', $Struct->field5);
	}

	public final function testSetters(){
		$Struct = new StructC('one', 'two', 'three', 'four', 'five');

		$this->assertEquals('more than one', $Struct->field1);
		$this->assertEquals('two', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
		$this->assertEquals('four', $Struct->field4);
		$this->assertEquals('less than five', $Struct->field5);
	}

	public final function testGetters(){
		$Struct = new StructD('one', 'two', 'three', 'four', 'five');
		$this->assertEquals('one', $Struct->field1);
		$this->assertEquals('two hundreds', $Struct->field2);
		$this->assertEquals('three', $Struct->field3);
		$this->assertEquals('four hundreds', $Struct->field4);
		$this->assertEquals('five', $Struct->field5);
	}

	public final function testEUndefinedField(){
		$Struct = new StructD('one', 'two', 'three', 'four', 'five');

		$this->expectException(EUndefinedField::class);
		$Struct->six = 6;
	}

	public final function testEInvalidFieldName(){
		$this->expectException(EInvalidFieldName::class);
		$Struct = new StructE('one', 'two', 'three', '_');
	}

	public final function testDefaultValues(){
		$Struct = new StructB();
		$this->assertSame($Struct->toArray(), [
			'field1'  => null,
			'field2' => null,
			'field3' => 'f3',
			'field4' => 'f4',
			'field5' => null
		]);

		$Struct = new StructB('one', null, null, 'four');
		$this->assertSame($Struct->toArray(), [
			'field1'  => 'one',
			'field2' => null,
			'field3' => 'f3',
			'field4' => 'four',
			'field5' => null
		]);
	}
}
