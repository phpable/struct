## Introduction
The lightweight library to emulate structures in PHP. 


## Requirements
* PHP >= 7.1.0
* [Eggbe/Helpers](https://github.com/eggbe/helpers)
* [Eggbe/Prototype](https://github.com/eggbe/prototype)


## Features 
Unfortunately, the most of known realizations are based on the runtime dynamical fields definition. 
We think it makes structures absolutely unusable because in this case, the type hinting is impossible. 

Some other realizations are free from this shortcoming but also they tend to use object properties for the structures fields behavior emulation. 
We believe this method is bad because sometimes it's impossible to detect the visibility of an arbitrary object property. 

It can cause additional problems and make a code completely unsupported.

So from our point of view, we have realized the structures functionality in the only possible way. 
But of course, if you don't share our beliefs you always can find another one package with the similar functionality.

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
$Struct = new MyStruct(1,2);

echo $Struct->field1;

//> 1
```

An alternate way of istant initialization is also possible:

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
$Struct = new MyStruct(1,2);

echo $Struct->field1;
echo $Struct->field2;

//> The mutated via setter value is: 1
//> The mutated via getter value is: 2
```

The easist way to illustrate the major difference between setters and getters it's to write the simple code bellow. 
It  will based on the class definition from the previous sample.

```php
$Data = $Struct->toArray();

echo $Data['field1'];
echo $Data['field2'];

//> The mutated via setter value is: 1
//> 2
```


### Inheritance

The inheritance level is not limited. It means we can have as extensive hierarchy as we really need it. 
All fields defined at parent classes are also accessible at child classes.

```php
use \Eggbe\Struct;

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

To retrieve all structure data as an array:
```php
$Struct->toArray();
```

To get a structure fields count:
```php
$Struct->count();
```

Of course you always can override any mutator via common way. 


## Authors
Made with love at [Eggbe](http://eggbe.com).

## Feedback 
We always welcome your feedback at [github@eggbe.com](mailto:github@eggbe.com).


## License
This package is released under the [MIT license](https://github.com/eggbe/struct/blob/master/LICENSE).
