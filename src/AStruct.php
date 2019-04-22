<?php
namespace Able\Struct;

use \Able\Prototypes\IGettable;
use \Able\Prototypes\ISettable;
use \Able\Prototypes\ICountable;
use \Able\Prototypes\IArrayable;

use \Able\Prototypes\TDefault;
use \Able\Prototypes\TMutatable;
use \Able\Prototypes\TAggregatable;

use \Able\Reglib\Regex;

use \Able\Helpers\Arr;
use \Able\Helpers\Src;

use \Able\Struct\Exceptions\EDataOverflow;
use \Able\Struct\Exceptions\EUndefinedField;
use \Able\Struct\Exceptions\EInvalidFieldName;

abstract class AStruct
	implements IGettable, ISettable, IArrayable {

	use TAggregatable;
	use TMutatable;
	use TDefault;

	/**
	 * Fields definition.
	 * @var string[]
	 */
	protected static array $Prototype = [];

	/**
	 * Structure data.
	 * @var array
	 */
	private array $Data = [];

	/**
	 * @param mixed $args, ...
	 *
	 * @throws EInvalidFieldName
	 * @throws EUndefinedField
	 * @throws EDataOverflow
	 */
	public function __construct($args = []) {
		$this->Data = Arr::combine(array_map(function($name) {
			if (preg_match('/^' . Regex::RE_VARIABLE . '$/', $name)) {
				return strtolower($name);
			}

			throw new EInvalidFieldName($name);
		}, $Aggregated  = static::aggregate('Prototype')));

		/**
		 * Ignoring extra arguments passed to the constructor
		 * can cause hardly recognizable errors.
		 */
		if (func_num_args() > count($Aggregated)) {
			throw new EDataOverflow(func_num_args(), count($Aggregated));
		}

		/**
		 * Fill structure by default values.
		 */
		$this->flush();

		/**
		 * Fill structure fields by given values.
		 * Mutators are doing their work.
		 */
		foreach (array_values(array_slice(func_get_args(), 0, count($Aggregated))) as $index => $value){
			if (!is_null($value)) {
				$this->__set(Arr::value($Aggregated, $index), $value);
			}
		}
	}

	/**
	 * @param string ...$names
	 * @return AStruct
	 */
	public final function flush(string ...$names): AStruct {

		/**
		 * Fill structure by default values.
		 * The default value can be specified by a specially formatted constant.
		 */
		foreach (array_filter(static::aggregate('Prototype'), function($_) use ($names) {
				return empty($names) || in_array($_, $names); }) as $name){

			/**
			 * We have to set default values to structure fields directly
			 * to avoid the type verification process is possible via setters.
			 */
			$this->Data[$name] = $this->mutate('init', $name,
				$this->default(Src::tcm($name)));
		}

		return $this;
	}

	/**
	 * Sets a structure field value directly
	 * or following the mutators mechanics.
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @throws EUndefinedField
	 */
	public final function __set(string $name, $value): void {
		if (!Arr::has($this->Data, $name = strtolower(trim($name)))){
			throw new EUndefinedField($name);
		}

		$this->Data[$name] = $this->mutate('set', $name, $value);
	}

	/**
	 * Retrieves a structure field value directly
	 * or following the mutators mechanics.
	 *
	 * @param string $name
	 * @return mixed
	 *
	 * @throws EUndefinedField
	 */
	public final function __get(string $name) {
		if (!Arr::has($this->Data, $name = strtolower(trim($name)))){
			throw new EUndefinedField($name);
		}

		return $this->mutate('get', $name, $this->Data[$name]);
	}

	/**
	 * @param string $name
	 * @throws EUndefinedField
	 */
	public final function __unset(string $name): void {
		if (!Arr::has($this->Data, $name = strtolower(trim($name)))){
			throw new EUndefinedField($name);
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
	public final function count(): int {
		return count($this->Data);
	}
}
