<?php

namespace App\Libs;

class Factory {
	/** @var  array $instance */
	private static $instance = [];
	public static $app_path = __DIR__.DS.'..';

	/**
	 * Returns a new object for a given class name.
	 * It can return a singletone object, or a comletely new object.
	 * @param string $class
	 * @param bool $singleton
	 * @return mixed|null
	 */
	private static $iii=0;
	public static function getInstance($class, $singleton = true) {
		if($singleton === true) {
			if(isset(self::$instance[$class])) {
				return self::$instance[$class];
			}

			self::$instance[$class] = new $class();
			return self::$instance[$class];
		}
		return new $class();
	}
	public static function setInstance($class, $object) {
		self::$instance[$class] = $object;
	}

	/**
	 * Autoloads a class for a given $class name.
	 * @param string $class
	 * @param bool $autoload
	 * @return bool Returns tru on success and false on failure.
	 */
	public static function autoload($class, $autoload = true) {
		$paths = [
			'controllers',
			'libs',
			'models'
		];
		foreach($paths as $path) {
			$file = self::$app_path.DS.$path.DS.$class.'.php';
			if(file_exists($file)) {
				if($autoload)
					require_once $file;
				return true;
			}
		}

		return false;
	}

	/**
	 * Checks whether a model exists or not.
	 * @param string $model
	 * @return bool
	 */
	public static function modelExists($model) {
		$file = self::$app_path.DS.'models'.DS.$model.'.php';
		return file_exists($file);
	}

	/**
	 * Checks whether a controller exists or not.
	 * @param string $controller
	 * @return bool
	 */
	public static function controllerExists($controller) {
		$file = self::$app_path.DS.'controllers'.DS.$controller.'.php';
		return file_exists($file);
	}
	
	/**
	 * Checks whether a view exists or not.
	 * @param string $controller
	 * @return bool
	 */
	public static function viewExists($view) {
		$file = self::$app_path.DS.'views'.DS.$view.'.php';
		return file_exists($file);
	}
}