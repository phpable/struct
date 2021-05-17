## Introduction
The phpABLE struct emulation library. 


## Requirements
* PHP >= 8.0.0
* [able/helpers](https://github.com/phpable/helpers)
* [able/prototypes](https://github.com/phpable/prototypes)


## Features 
The mission of this library is to emulate 
the structures' behavior most naturally. 

## Install
There's a simple way to install the ```able/struct``` package via [composer](http://getcomposer.org):

```bash
composer require able/struct
```


## Usage

### Basic 
Let's try to declare a structure:

```php
use \Able\Struct;

class MyStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
}
```

Now we can use it in a siple way: 

```php
$Struct = new MyStruct(1,2);
echo $Struct->field1;

//> 1
```

It's also possible to fill fields later:

```php
$Struct = new MyStruct();

$Struct->field1 = "Test string!";
echo $Struct->field1;

//> Test string!
```

### Mutators
Mutators are pretty helpful in case it needed 
to customize the default structure behavior. 
 
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

Let's test it: 

```php
$Struct = new MyStruct(1,2);

echo $Struct->field1;
echo $Struct->field2;

//> The mutated via setter value is: 1
//> The mutated via getter value is: 2
```

The next example just illustrates the difference between setters and getters.

```php
$Data = $Struct->toArray();

echo $Data['field1'];
echo $Data['field2'];

//> The mutated via setter value is: 1
//> 2
```


### Default values
The default values could be set via constants. 

```php
use \Able\Struct;

class MyParentStruct extends AStruct {

	protected static array $Prototype = ['field1', 'field2'];
	
	protected const defaultField1Value = "default value for field1";
	protected const defaultField2Value = "default value for field2";
}
```

### Inheritance

The inheritance level isn't limited. 
All fields defined at parent classes will also be accessible at child classes.


```php
use \Able\Struct;

class MyParentStruct extends AStruct {

	protected static array $Prototype = ['field1', 'field2'];
}

class MyChildStruct extends MyParentStruct {

	protected static array $Prototype = ['field3'];
}
``` 

It perfectly works: 

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

To get fields count:
```php
$Struct->count();
```

To clean all fields and restore its default values:
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

	protected static array $Prototype = ['field1', 'field2'];
}
```

## License
This package is released under the [MIT license](https://github.com/phpable/struct/blob/master/LICENSE).
