<?php

require_once(__DIR__.'/../lib/JBuilder.php');

class JBuilderTest extends PHPUnit_Framework_TestCase
{
	public function testSingleKeyAssign()
	{
		$json = JBuilder::encode(function($json) {
			$json->a = 42;
		});

		$this->assertEquals('{"a":42}', $json);
	}

	public function testSingleKeyCall()
	{
		$json = JBuilder::encode(function($json) {
			$json->a(42);
		});

		$this->assertEquals('{"a":42}', $json);
	}

	public function testNesting()
	{
		$json = JBuilder::encode(function($json) {
			$json->a(function($json) {
				$json->b(function($json) {
					$json->c = "d";
				});
			});
		});

		$this->assertEquals('{"a":{"b":{"c":"d"}}}', $json);
	}

	public function testArray()
	{
		$json = JBuilder::encode(function($json) {
			$json->a(array(1,2,3));
		});

		$this->assertEquals('{"a":[1,2,3]}', $json);
	}

	public function testArrayMap()
	{
		$json = JBuilder::encode(function($json) {
			$json->a(array(1,2,3), function($json, $e) { return $e + 5; });
		});

		$this->assertEquals('{"a":[6,7,8]}', $json);
	}

	public function testArrayMapObject()
	{
		$json = JBuilder::encode(function($json) {
			$json->a(array(1,2,3), function($json, $e) {
				$json->b = $e;
			});
		});

		$this->assertEquals('{"a":[{"b":1},{"b":2},{"b":3}]}', $json);
	}


}
