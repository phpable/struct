<?php
namespace Eggbe\Struct;

use \Eggbe\Prototype\IGettable;
use \Eggbe\Prototype\ISettable;
use \Eggbe\Prototype\TMutatable;
use \Eggbe\Prototype\IArrayable;
use \Eggbe\Prototype\TAggregatable;

use \Eggbe\Reglib\Reglib;
use \Eggbe\Helper\Arr;

abstract class AStruct
	implements IGettable, ISettable, IArrayable {

	use TAggregatable;
	use TMutatable;

	/**
	 * Strusture fields definition.
	 * @var array
	 */
	protected static $Prototype = [];

	/**
	 * Structure data.
	 * @var array
	 */
	private $Data = [];

	/**
	 * @param array $Values
	 * @throws \Exception
	 */
	public function __construct(array $Values = []) {
		$this->Data = Arr::combine(array_map(function($name) {
			if (preg_match('/^' . Reglib::VAR . '$/', $name)) {
				return strtolower($name);
			}

			throw new \Exception('Invalid or empty structure field name!');
		}, static::aggregate('Prototype')));

		/**
		 * Fill structure fields by given values.
		 * Mutators are fully accessible here so no reason to worry.
		 */
		foreach (array_values(array_slice($Values, 0, count(static::$Prototype))) as $index => $value){
			$this->__set(Arr::val(static::$Prototype, $index), $value);
		}
	}

	/**
	 * Sets a structure field value directly or via the mutators mechanics.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @throws \Exception
	 */
	public final function __set(string $name, $value) {
		if (!Arr::has($this->Data, $name = strtolower(trim($name)))){
			throw new \Exception('Undefined structure member "' . $name . '"!');
		}

		$this->Data[$name] = $this->mutate('set', $name, $value);
	}

	/**
	 * Retrieves a structure field value directly or via the mutators mechanics.
	 *
	 * @param string $name
	 * @throws \Exception
	 * @return mixed
	 */
	public final function __get(string $name) {
		if (!Arr::has($this->Data, $name = strtolower(trim($name)))){
			throw new \Exception('Undefined structure member "' . $name . '"!');
		}

		return $this->mutate('get', $name, $this->Data[$name]);
	}

	/**
	 * @param string $name
	 * @throws \Exception
	 */
	public final function __unset(string $name){
		if (!Arr::has($this->Data, $name = strtolower(trim($name)))){
			throw new \Exception('Undefined structure member "' . $name . '"!');
		}

		$this->Data[$name] = null;
	}

	/**
	 * @param string $name
	 * @return bool
	 */
	public final function __isset(string $name): bool {
		return Arr::has($this->Data, strtolower(trim($name)));
	}

	/**
	 * @return array
	 */
	public final function keys(): array {
		return array_keys($this->Data);
	}

	/**
	 * @return array
	 */
	public final function values(): array {
		return array_values($this->Data);
	}

	/**
	 * @return array
	 */
	public final function toArray(): array {
		return $this->Data;
	}
}


