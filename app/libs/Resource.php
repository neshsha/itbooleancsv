<?php

namespace App\Libs;
use App\Libs\Router;

class Resource {
	/** @var  bool[] $arr */
	private $arr = [];


	/**
	 * Sets the variable with the given key and value.
	 * @param string $key
	 * @param mixed $value
	 * @param bool $require
	 */
	public function set($key, $value, $require = false) {
		$this->$key = $value;
		$this->arr[$key] = [$value, $require];
	}

	/**
	 * @param $property
	 * @return mixed|string
	 */
	public function __get($property) {
		if(isset($this->$property))
			return $this->$property;
		return '';
	}

	/**
	 * Echos the variable or does require_once the path.
	 * @param string $key
	 * @return bool
	 */
	public function get($key) {
		if(isset($this->arr[$key])) {
			if($this->arr[$key][1] === false) {
				echo $this->arr[$key][0];
				return true;
			} else {
				require_once $this->arr[$key][0];
				return true;
			}
		}
		return false;
	}

	public function url($url) {
		return Router::url($url);
	}

	public function urlHref($url) {
		return $this->url($url) . (isset($this->lang) ? '?lang='.$this->lang : '');
	}

    public function urlAsset($url) {
        return Router::urlAsset($url);
    }

	public function page() {
		$part = ltrim(str_replace('/', '_', $_SERVER['REQUEST_URI']), '_');
		$pos = strpos($part, '?');
		if($pos <= 0)
			$pos = strlen($part);
		return str_replace('mef_', '', substr($part, 0, $pos));
	}

}