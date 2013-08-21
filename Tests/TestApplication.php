<?php
/**
 * Test application class
 *
 * @file    TestApplication.php
 *
 * PHP version 5.3.9+
 *
 * @author  Yancharuk Alexander <alex@itvault.info>
 * @date    Сбт Фев 16 17:01:16 2013
 * @copyright The BSD 3-Clause License.
 */
namespace Tests;

use \Veles\Application\Application;
use \Veles\Tools\CliColor;

/**
 * Class TestApplication
 * @package Classes
 */
class TestApplication extends Application
{
	/**
	 * @var array Results array
	 */
	private static $results = array();
	protected static $repeats = 10000;

	/**
	 * @param int $repeats
	 */
	public static function setRepeats($repeats)
	{
		static::$repeats = $repeats;
	}

	/**
	 * @return int
	 */
	public static function getRepeats()
	{
		return static::$repeats;
	}

	/**
	 * @param array $results
	 */
	public static function setResults($results)
	{
		self::$results = $results;
	}

	/**
	 * @return array
	 */
	public static function getResults()
	{
		return self::$results;
	}

	/**
	 * Display results
	 */
	final public static function showResults()
	{
		$results = self::getResults();
		asort($results);
		$best = key($results);
		$string = new CliColor;

		printf(
			"%-10s\t%-15s\t%-10s\t%-15s\n",
			'Server', 'Queries count', 'Result', 'Performance'
		);

		foreach ($results as $name => $value) {
			$color = ($name === $best || $results[$best] === $value)
				? 'green' : 'red';

			$percent = self::getPercentDiff($results[$best], $value);

			$string->setColor($color);
			$string->setString($value);
			printf(
				"%-10s\t%-15s\t%-10s sec\t%-15s\n",
				$name, self::getRepeats(), $string, $percent . ' %'
			);
		}
	}

	final public static function getPercentDiff($best, $current)
	{
		$diff = $current - $best;
		$percent = $best / 100;
		$value = round($diff / $percent, 3);

		$result = new CliColor;

		if ($value > 0) {
			$result->setColor('red');
			$result->setstring("-$value");
		} else {
			$result->setColor('green');
			$result->setstring("+$value");
		}

		return $result;
	}

	/**
	 * Add result for further displaying
	 *
	 * @param string $name
	 * @param float $value
	 */
	final public static function addResult($name, $value)
	{
		self::$results[$name] = $value;
	}
}