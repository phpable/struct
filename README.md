## Introduction
The lightweight library to emulate struct data type in PHP. 


## Requirements
* PHP >= 7.2.0
* [Able/Helpers](https://github.com/phpable/helpers)
* [Able/Prototypes](https://github.com/phpable/prototypes)


## Features 
The most of existing realizations in this area based on the dynamical fields definition 
directly during the runtime. Unfortunately, it negates the type-hinting feature and makes 
structures completely unusable. Using object properties as a way to emulate the behavior 
of structure fields is also inapplicable because php has none obvious way to detect 
visibility of an object property. Also, It tends to cause additional problems 
and makes code hard to maintain.

The mission of this library is to provide 
another one realization of the structures behavior emulation but make it free 
of known disadvantages.  

## Install
Here's the simpler way to install the Able/Struct package via [composer](http://getcomposer.org):

```bash
composer require able/struct
```


## Usage

### Basic 
Now you can use library features anywhere in the code:

```php
use \Able\Struct;

class MyStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
}
```

And somewhere in another place: 

```php
$Struct = new MyStruct(1,2);

echo $Struct->field1;

//> 1
```

An alternate way of instant initialization is also possible:

```php
$Struct = new MyStruct([1, 2]);

echo $Struct->field1;

//> 1
```

Of course, we also can fill fields later:

```php
$Struct = new MyStruct();

$Struct->field1 = "Test string!";
echo $Struct->field1;

//> Test string!
```

### Mutators
If you need to customize the structure behavior, well mutators are 
the thing you need. 
 
```php
use \Able\Struct;

class MyStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
	
	protected final function setField1Property($value) {
		return 'The mutated via setter value is: ' . $value;
	}
	
	protected final function getField2Property($value) {
		return 'The mutated via getter value is: ' . $value;
	}
}
```

And somewhere in another place: 

```php
$Struct = new MyStruct(1,2);

echo $Struct->field1;
echo $Struct->field2;

//> The mutated via setter value is: 1
//> The mutated via getter value is: 2
```

The easiest way to illustrate the difference between setters and getters it's 
to write the simple code below. It will be based on the class definition from the previous sample.

```php
$Data = $Struct->toArray();

echo $Data['field1'];
echo $Data['field2'];

//> The mutated via setter value is: 1
//> 2
```


### Default values
If you need to specify default values for structure fields, 
the well-formed constants can be extremely useful. 

Just take a look at the example below: 

```php
use \Able\Struct;

class MyParentStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
	
	protected const defaultField1Value = "default value for field1";
	protected const defaultField2Value = "default value for field2";
}
```

Please pay attention that constant has to be defined in public or projected scope. 


### Inheritance

The level of inheritance is not limited. It means you can have the as extensive 
hierarchy as you really need.  It also guarantees that all fields defined at parent 
classes will also be accessible at child classes.


```php
use \Able\Struct;

class MyParentStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
}

class MyChildStruct extends MyParentStruct {

	protected static $Prototype = ['field3'];
}
``` 

And somewhere in another place: 

```php
$Struct = new MyChildStruct(1,2,3);

echo $Struct->field1;
echo $Struct->field2;
echo $Struct->field3;

//> 1
//> 2
//> 3
```


### Advanced

To retrieve all structure keys: 

```php
$Struct->keys();
```

To retrieve all structure values: 

```php
$Struct->values();
```

To copy all data into an array:
```php
$Struct->toArray();
```

To get a fields count:
```php
$Struct->count();
```

To clean structure fields values and restore its default state:
```php
$Struct->flush();
```


## IDEs support 
If you use a PHPDoc-friendly IDE you 
can gain additional advantages by using the syntax below: 

```php
use \Able\Struct;

/**
 * @property int field1
 * @property string field2
 */
class MyStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
}
```


## Authors
Made with love at [Eggbe](http://eggbe.com).

## Feedback 
We always welcome your feedback at [github@eggbe.com](mailto:github@eggbe.com).

## License
This package is released under the [MIT license](https://github.com/phpable/struct/blob/master/LICENSE).
