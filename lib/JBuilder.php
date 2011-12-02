<?php

class JBuilder
{
	private $_object;

	public static function encode($fn)
	{
		$json = new self();
		$fn($json);
		return "$json";
	}

	public function __construct($object=null)
	{
		$this->_object = $object ? $object : new stdClass();
	}

	public function __set($name, $value)
	{
		return $this->_object->$name = $value;
	}

	public function __call($name, $args)
	{
		if (count($args) == 1 && is_callable($args[0]))
		{
			$json = new self();
			call_user_func($args[0], $json);
			$this->_object->$name = $json->_object;
		}
		elseif (count($args) == 2 && is_callable($args[1]))
		{
			$result = array();
			foreach ($args[0] as $e)
			{
				$json = new self();
				$ret = call_user_func($args[1], $json, $e);
				$result []= isset($ret) ? $ret : $json->_object;
			}
			$this->_object->$name = $result;
		}
		else
		{
			$this->_object->$name = $args[0];
		}
	}

	public function __toString()
	{
		return json_encode($this->_object);
	}
}
