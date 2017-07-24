## Introduction
This is the lightweight library to emulate structures in PHP. 


## Requirements
* PHP >= 7.0.0
* [Eggbe/Helpers](https://github.com/eggbe/helpers)
* [Eggbe/Prototype](https://github.com/eggbe/prototype)


## Features 
Unfortunately the most of the known realisations in this area are based on the dynamical fields definition directly at runtime. 
We think it makes structures absolutely unusable because in this case the type hinting is impossible. 

Also we have found few realisations that are free from this shortcoming but at the same time 
they tend to use object properties for the structures fields behavior emulation. We believe this method is bad 
because sometimes we haven't any regular way to detect the visibility of an object property.
It can cause additional problems and make a code completely unsupported. 

So from our point of view we made this realisation of the structures functionality by the only possible way. 
But of course if you don't share our beliefs you always can find another one package with the similar functionality. 


## Install
Here's the simpler way to install the Eggbe/Struct package via [composer](http://getcomposer.org):

```bash
composer require eggbe/struct
```


## Usage

### Basic 
Now you can use the library features anywhere in the code:

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
If you need to customize the standard structure behavior well mutators are all you need. 

```php
use \Eggbe\Struct;

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
