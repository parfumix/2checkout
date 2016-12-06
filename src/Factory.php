<?php

namespace Omnipay\Two2Checkout;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class Factory {

	/**
	 * @var array
	 */
	protected static $gateways = array();

	/**
	 * @var array
	 */
	protected static $aliases = array();

	/**
	 * Get all gateways .
	 *
	 * @return array
	 */
	public static function all() {
		return self::$gateways;
	}

	/**
	 * Register new gateway .
	 *
	 * @param string $class
	 * @param array $parameters
	 * @return bool|void
	 */
	public function register($class, array $parameters = array()) {
		if (! class_exists($class))
			throw new RuntimeException("Class '$class' not found");

		if ( in_array($class, self::$gateways) )
			return $this;

		self::$gateways[$class] = $parameters;

		return $this;
	}

	/**
	 * Adding alias to specific class .
	 *
	 * @param $alias
	 * @param $class
	 * @return $this
	 */
	public function alias($alias, $class) {
		if (! class_exists($class))
			throw new RuntimeException("Class '$class' not found");

		if ( ! in_array($class, self::$gateways) )
			throw new RuntimeException("Class '$class' not found");

		if ( in_array($alias, self::$aliases) )
			return $this;

		self::$aliases[$alias] = $class;

		return $this;
	}

	/**
	 * Create new gateway instance .
	 *
	 * @param string $class
	 * @param ClientInterface|null $httpClient
	 * @param HttpRequest|null $httpRequest
	 * @return mixed
	 */
	public function create($class, ClientInterface $httpClient = null, HttpRequest $httpRequest = null) {
		$class = isset(self::$aliases[$class])
			? self::$aliases[$class]
			: $class;

		if (! class_exists($class))
			throw new RuntimeException("Class '$class' not found");

		$params = isset(self::$gateways[$class])
			? self::$gateways[$class]
			: array();

		return (new $class($httpClient, $httpRequest))
			->initialize($params);
	}

}