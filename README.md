## Introduction
This is the lightweight library to emulate structures in PHP. 

## Requirements
* PHP >= 7.0.0
* [Eggbe/Helpers](https://github.com/eggbe/helpers)
* [Eggbe/Prototype](https://github.com/eggbe/prototype)


## Install
Here's the simpler way to install the Eggbe/Struct package via [composer](http://getcomposer.org):

```bash
composer require eggbe/struct
```


## Usage

### Basic 
Now we can use the library features anywhere in the code:

```php
use \Eggbe\Struct;

class MyStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
}
```

And somewhere in another place: 

```php
$Struct = new MyStruct([1,2]);

echo $Struct->field1;

//> 1
```

```php
$Struct = new MyStruct();

$Struct->field1 = "Test string!";
echo $Struct->field1;

//> Test string!
```

### Mutators
If we need to customize the standard structure behavior well mutators are all we need. 

```php
use \Eggbe\Struct;

class MyStruct extends AStruct {

	protected static $Prototype = ['field1', 'field2'];
	
	protected final function setField1Property($value) {
		return 'This mutated via setter value is: ' . $value;
	}
	
	protected final function getField2Property($value) {
		return 'This mutated via getter value is: ' . $value;
	}
}
```

And somewhere in another place: 

```php
$Struct = new MyStruct([1,2]);

echo $Struct->field1;
echo $Struct->field2;

//> This mutated via setter value is: 1
//> This mutated via getter value is: 2
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

To retrieve all structure data as an array:
```php
$Struct->toArray();
```

## Authors
Made with love at [Eggbe](http://eggbe.com).

## Feedback 
We always welcome your feedback at [github@eggbe.com](mailto:github@eggbe.com).


## License
This package is released under the [MIT license](https://github.com/eggbe/struct/blob/master/LICENSE).
