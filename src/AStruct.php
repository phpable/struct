<?php
namespace Able\Struct;

use \Able\Prototypes\IGettable;
use \Able\Prototypes\ISettable;
use \Able\Prototypes\ICountable;
use \Able\Prototypes\TMutatable;
use \Able\Prototypes\IArrayable;
use \Able\Prototypes\TAggregatable;

use \Able\Reglib\Reglib;

use \Able\Helpers\Arr;
use \Able\Helpers\Src;

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
	 * @param mixed $args, ...
	 * @throws \Exception
	 */
	public function __construct($args = []) {
		$this->Data = Arr::combine(array_map(function($name) {
			if (preg_match('/^' . Reglib::VAR . '$/', $name)) {
				return strtolower($name);
			}

			throw new \Exception('Invalid or empty structure field name!');
		}, $Aggregated  = static::aggregate('Prototype')));

		/**
		 * Fill structure by default values.
		 */
		$this->flush();

		/**
		 * Fill structure fields by given values.
		 * Mutators are fully accessible here so no reason to worry.
		 */
		foreach (array_values(array_slice(Arr::simplify(func_get_args()), 0, count($Aggregated))) as $index => $value){
			if (!is_null($value)) {
				$this->__set(Arr::value($Aggregated, $index), $value);
			}
		}
	}

	/**
	 * @return AStruct
	 */
	public function flush(){

		/**
		 * Fill structure by default values.
		 * The default value can be specified by a specially formatted constant.
		 */
		foreach (static::$Prototype as $name){
			$this->Data[$name] = defined($constant = static::class
				. '::default' . Src::tcm($name) . 'Value') ? constant($constant) : null;
		}

		return $this;
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

	/**
	 * @return int
	 */
	public final function count():int {
		return count($this->Data);
	}
}


