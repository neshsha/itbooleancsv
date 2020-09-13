<?php

namespace App\Libs;

class Session {
	private static function randomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[rand(0, $max)];
		}
		return $str;
	}

	public function __construct() {
		//session_save_path(__DIR__.'/../sessions');
		//ini_set('session.gc_probability', 1);
		//ini_set('session.cookie_lifetime', 8000);
		//ini_set('session.gc_maxlifetime', 8000);
		if(session_status() == PHP_SESSION_NONE)
			session_start();
	}

	/**
	 * @param $name string
	 * @param $value string
	 * @return Session
	 */
	public function set($name, $value) {
		$this->$name = $value;
		$_SESSION[$name] = $value;
		return $this;
	}

	/**
	 * @param $name string
	 * @return Session
	 */
	public function unsetSession($name) {
		unset($this->$name);
		unset($_SESSION[$name]);
		return $this;
	}

	/**
	 * @param $name;
	 * @return string|null
	 */
	public function get($name) {
		if(isset($this->$name))
			return $this->$name;
		if(isset($_SESSION[$name]))
			return $_SESSION[$name];
		return null;
	}

	/**
	 * @return Session
	 */
	public function destroy() {
		session_destroy();
		return $this;
	}
}