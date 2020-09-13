<?php

namespace App\Libs;

class Router {
	private $arr = [
		'0' => 'prvi',
		'1' => 'drugi',
		'2' => 'treci',
		'3' => 'cetvrti',
		'4' => 'peti',
		'6' => 'sesti',
		'7' => 'sedmi'
	];

	public function __construct() {
		global $resource;
		Factory::setInstance('App\Libs\Router', $this);
		
		foreach($_POST as $key => $value) {
			$resource->set($key, $value);
		}
		foreach($_GET as $key => $value) {
			$resource->set($key, $value);
		}
		/** @var \App\Controllers\Root $root */
		$root = Factory::getInstance('App\Controllers\Root');
		if(!empty($_GET['url'])) {
			$url = $_GET['url'];
			$url = rtrim($url, '/');
			$url = explode('/', $url);
			foreach($url as $key => $value) {
				if(isset($this->arr[$key]))
					$resource->set($this->arr[$key], $value);
				else
					$resource->set($key, $value);
			}

			foreach($_GET as $key => $value) {
				if($key === 'url')
					continue;
				$resource->set($key, $value);
			}

			if(!empty($resource->prvi)) {
				$prvi = $resource->prvi;
				if(Factory::controllerExists(ucfirst($prvi))) {
					$app = Factory::getInstance('App\Controllers\\'.ucfirst($prvi));
					if(!empty($resource->drugi)) {
						$drugi = $resource->drugi;
						if(method_exists($app, $drugi)) {
							$app->$drugi($resource);
						} else if(method_exists($root, $prvi)) {
							$root->$prvi($resource);
						} else {
							$app->error($resource);
						}
					} else {
						$app->main($resource);
					}
				} else {
					if(method_exists($root, $prvi))
						$root->$prvi($resource);
					else
						$root->error($resource);
				}
			} else
				$root->main($resource);
		} else
			$root->main($resource);
	}

	/**
	 * Returns fully qualified URL for the given path.
	 * If the path is already URL, method returns the same
	 * path as provided.
	 * @param $url string
	 * @return string
	 */
	public static function url($url) {
		if(strpos($url, 'http://') !== false || strpos($url, 'https://') !== false)
            return $url;
		$dir = 'http://'.$_SERVER['SERVER_NAME'].'/';
		return $dir.ROOT.$url;
	}

	/**
	 * @param $url string
	 * @return string
	 */
    public static function urlAsset($url) {
        $dir = 'http://assets.mef.edu.rs/';
        return $dir.$url;
    }
}